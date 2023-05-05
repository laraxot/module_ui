<?php

declare(strict_types=1);

namespace Modules\UI\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\File;
use Modules\Xot\Traits\SushiConfigCrud;
use Nwidart\Modules\Facades\Module;
use Sushi\Sushi;

/**
 * Modules\UI\Models\Menu.
 *
 * @property int                                                                    $id
 * @property string|null                                                            $name
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\UI\Models\MenuItem[] $items
 * @property int|null                                                               $items_count
 *
 * @method static Builder|Menu newModelQuery()
 * @method static Builder|Menu newQuery()
 * @method static Builder|Menu query()
 * @method static Builder|Menu whereId($value)
 * @method static Builder|Menu whereName($value)
 *
 * @mixin \Eloquent
 */
class Menu extends Model
{
    use Sushi;
    use SushiConfigCrud;

    protected string $config_name = 'menu_builder';

    protected $fillable = ['id', 'name'];

    protected $table = 'menus';
    /*
    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->table = config('menu.table_prefix') . config('menu.table_name_menus');
    }
    */

    public function getRows(): array
    {
        $route_params = getRouteParameters();
        $rows = null;
        if (inAdmin() && isset($route_params['module'])) {
            $menu_path = Module::getModulePath($route_params['module']).'Resources/menu/'.$this->getTable().'.php';
            if (File::exists($menu_path)) {
                $rows = File::getRequire($menu_path);

            // dddx($this->config_name);
            } else {
                // dddx($menu_path);
            }
        } else {
            $rows = config($this->config_name);
        }
        if (! \is_array($rows)) {
            return
            [
                [
                    'id' => 1,
                    'name' => 'test',
                ],
            ];
        }

        return $rows;
    }

    public static function byName(string $name): ?self
    {
        return self::where('name', '=', $name)->first();
    }

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'menu')
            ->with('child')
            ->where(function ($query) {
                $query->where('parent', 0)->orWhere('parent', null);
            })
            ->orderBy('sort', 'ASC');
    }
}

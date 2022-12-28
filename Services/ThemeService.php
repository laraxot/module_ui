<?php

declare(strict_types=1);

namespace Modules\UI\Services;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Modules\Cms\Contracts\PanelContract;
use Modules\Cms\Services\PanelService;
use Modules\Cms\Services\RouteService;
use Modules\Tenant\Services\TenantService;
use Modules\UI\Datas\FieldData;
use Modules\Xot\Services\ArtisanService;
use Modules\Xot\Services\FileService;
use Modules\Xot\Services\StubService;
use Modules\Xot\Traits\Getter;

// ---------CSS------------

/**
 * Class ThemeService.
 */
class ThemeService {
    use Getter;

    protected static string $config_name = 'metatag';

    protected static array $vars = [];

    private static ?self $instance = null;

    public static array $attrs;

    public static array $classes;

    public static function getInstance(): self {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function make(): self {
        return static::getInstance();
    }

    /**
     * get_url.
     */
    public static function get_url(array $params): string {
        return url('/');
    }

    public static function get_tags(array $params): array {
        return [];
    }

    public static function get_styles(array $params): array {
        return [];
    }

    public static function get_scripts(array $params): array {
        return [];
    }

    /*
    public static function get_langs(array $params){
        $cache_key = Str::slug(req_uri().'_langs');
        $langs = Cache::get($cache_key);
        if (! is_array($langs)) {
            $langs = [];
        }

        return $langs;
    }
    */

    public static function get_scripts_pos(array $params): array {
        return [];
    }

    public static function get_styles_pos(array $params): array {
        return [];
    }

    public static function get_view_params(array $params): array {
        return [];
    }

    public static function get_language(array $params): string {
        $lang = app()->getLocale();
        /**
         * @var array
         */
        $locale = config('laravellocalization.supportedLocales.'.$lang);

        return $locale['regional'];
    }

    public static function add(string $file, ?int $position = null): void {
        $path_parts = pathinfo($file);

        if (! isset($path_parts['extension'])) {
            throw new \Exception('$path_parts with index extension is null');
        }

        $ext = mb_strtolower($path_parts['extension']);
        switch ($ext) {
            case 'css':
                /* return */
                self::addStyle($file, $position);
                break;
            case 'scss':
                /* return */
                self::addStyle($file, $position);
                break;
            case 'js':
                /* return */
                self::addScript($file, $position);
                break;
            default:
                echo '<h3>'.$file.'['.$ext.']</h3>';
                dddx('['.__LINE__.']['.__FILE__.']');
                break;
        }

        // return;
    }

    public static function addStyle(string $style, ?int $position = null): void {
        if (null === $position) {
            /**
             * @var array
             */
            $styles = self::__getStatic('styles');
            $position = \count($styles) + 10;
        }
        $styles_pos = self::__merge('styles_pos', [$position]);
        $styles = self::__merge('styles', [$style]);
    }

    public static function addScript(string $script, ?int $position = null): void {
        if (null === $position) {
            /**
             * @var array
             */
            $scripts = self::__getStatic('scripts');
            $position = \count($scripts) + 10;
        }

        $scripts_pos = self::__merge('scripts_pos', [$position]);
        $scripts = self::__merge('scripts', [$script]);
    }

    /*
    public static function addViewParam($key, $value = null){
        $view_params = self::__getStatic('view_params');
        if (!\is_array($key)) {
            $view_params[$key] = $value;
        } else {
            $view_params = \array_merge($view_params, $key);
        }
        self::__setStatic('view_params', $view_params);

        return self::getInstance(); /// per il fluent, o chaining
    }

    public static function addFavicon($src, $attrs = []){
        $newsrc = self::getFileUrl($src);

        $favicon = '<link rel="shortcut icon" href="'.$newsrc.'"';
        foreach ($attrs as $k => $v) {
            $favicon .= ' '.$k.'="'.$v.'"';
        }

        return $favicon.'/>';
    }*/
    /*
    public static function addContentTools(array $params = []) {
        self::add('theme/bc/ContentTools/build/content-tools.min.css');
        self::add('theme/bc/ContentTools/build/content-tools.min.js');
        self::add('blog::js/contenttools.js');
        self::add('theme/bc/ContentTools/sandbox/sandbox.css');
    }

    public static function addSelect2(array $params = []) {
        $tipo = 2; //0 bc, 1 cdn ,2  mix
        switch ($tipo) {
            case 0:
                // librerie in locale
                self::add('theme/bc/select2/dist/css/select2.min.css');
                self::add('theme/bc/select2-bootstrap4-theme/dist/select2-bootstrap4.css');
                self::add('theme/bc/popper.js/dist/popper.min.js');
                self::add('theme/bc/select2/dist/js/select2.full.min.js');
                self::add('theme::js/select2ajax.js');
            break;
            case 1:
                //* librerin in cdn
                self::add('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css');
                self::add('theme/bc/select2-bootstrap4-theme/dist/select2-bootstrap4.css');
                self::add('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js');
                self::add('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js');
            break;
            case 2:
                //mix , non va aggiunto nulla
            break;
        }
        self::add('theme::js/select2ajax.js');
    }
    */
    /* deprecated
    public static function view_path($view) {
        $viewNamespace = '---';
        $pos = \mb_strpos($view, '::');

        if ($pos) {
            $hints = \mb_substr($view, 0, $pos);
            $filename = \mb_substr($view, $pos + 2);
            $viewHints = View::getFinder()->getHints();
            if (isset($viewHints[$hints][0])) {
                $viewNamespace = $viewHints[$hints][0];

                $out = $viewNamespace.\DIRECTORY_SEPARATOR.$filename;
                $out = str_replace(['\\', '/'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $out);

                return $out;
            } else {
                $viewNamespace = '---';
            }
        }

        return $viewNamespace;
    }
    */

    /**
     * @param string $src
     *
     * @return bool|mixed|string
     */
    public static function img_src($src) {
        // /$srcz = self::viewNamespaceToUrl([$src]);
        // $src = $srcz[0];
        return self::asset($src);
    }

    /**
     * @return string
     */
    public static function logo_html() {
        /**
         * @var string
         */
        $logo_src = self::metatag('logo_img');
        $newsrc = FileService::getFileUrl($logo_src);
        $logo_alt = self::metatag('logo_alt');
        $attrs = [];
        $attrs['alt'] = $logo_alt;
        $img = '<img src="'.$newsrc.'"';
        foreach ($attrs as $k => $v) {
            $img .= ' '.$k.'="'.$v.'"';
        }

        return $img.'/>';
    }

    /**
     * @param string $src
     * @param array  $attrs
     * @param bool   $only_url
     *
     * @return string
     */
    public static function showImg($src, $attrs = [], $only_url = false) {
        $srcz = FileService::viewNamespaceToUrl([$src]);
        $src = $srcz[0];
        $newsrc = FileService::getFileUrl($src);
        if ($only_url) {
            return $newsrc;
        }
        $img = '<img src="'.$newsrc.'"';
        foreach ($attrs as $k => $v) {
            $img .= ' '.$k.'="'.$v.'"';
        }

        return $img.'/>';
    }

    /**
     * @param string $path
     *
     * @return bool|string
     */
    public static function getNameSpace($path) {
        $pos = mb_strpos($path, '::');
        if (false === $pos) {
            return false;
        }

        return mb_substr($path, 0, $pos);
    }

    public static function asset(?string $path): string {
        if (null === $path) {
            return '';
        }

        return FileService::asset($path);
    }

    public static function showScripts(): Renderable {
        /**
         * @var array
         */
        $scripts_pos = self::__getStatic('scripts_pos');

        /**
         * @var array
         */
        $scripts = self::__getStatic('scripts');

        $scripts = array_values(
            Arr::sort(
                $scripts,
                function ($v, $k) use ($scripts_pos) {
                    return $scripts_pos[$k];
                }
            )
        );
        $scripts = array_unique($scripts);

        $scripts = collect($scripts)->map(
            function ($item) {
                return self::asset($item);
            }
        )->all();

        $scripts = array_unique($scripts);

        /**
         * @phpstan-var view-string
         */
        $view = 'ui::services.script';

        $view_params = [
            'view' => $view,
            'scripts' => $scripts,
        ];

        return view($view, $view_params);
    }
    // end function

    /**
     * @param bool $compress_css
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public static function showStyles($compress_css = true) {
        /**
         * @var array
         */
        $styles_pos = self::__getStatic('styles_pos');
        /**
         * @var array
         */
        $styles = self::__getStatic('styles');
        /**
         * @var array
         */
        $styles = array_values(
            \Arr::sort(
                $styles,
                function ($v, $k) use ($styles_pos) {
                    return $styles_pos[$k];
                }
            )
        );
        $styles = array_unique($styles);

        // $styles = self::viewNamespaceToUrl($styles);
        $styles = collect($styles)->map(
            function ($item) {
                return self::asset($item);
            }
        )->all();

        return view()->make('ui::services.style')->with('styles', $styles);
    }

    /**
     * @return string
     */
    public static function metatags() {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::metatags';

        return (string) view($view)->render();
    }

    /**
     * @param string $index
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public static function metatag($index) {
        $ris = self::__getStatic($index);
        // echo '<br/>['.$index.']['.$ris.']';
        if ('' === $ris || null === $ris) {
            $ris = config('metatag.'.$index);
            self::__setStatic($index, $ris);
        }

        return $ris;
    }

    /**
     * SetMetatags function.
     */
    public static function setMetatags(Model $row): void {
        // dddx($row);
        $params = getRouteParameters();
        foreach ($params as $v) {
            if (\is_object($v) && isset($v->title)) {
                self::__concatBeforeStatic('title', $v->title.' | ');
            }
        }
        if (! \is_object($row)) {
            return; // forse buttare in 404 ..
        }
        // -- solo i campi che interessano
        $fields = ['subtitle', 'meta_description', 'meta_keywords', 'url', 'type', 'updated_at', 'published_at'];
        foreach ($fields as $field) {
            self::__setStatic($field, $row->getAttributeValue($field));
        }
        // self::__concatBeforeStatic('title', $row->title.' | ');
        // dddx(self::__getStatic('title'));
        // self::__concatBeforeStatic('subtitle', $row->subtitle.' | ');
        // self::__setStatic('url', $row->url);
        // self::__setStatic('category', $row->post_type);
        // self::__setStatic('published_at', $row->published_at);
        // self::__setStatic('updated_at', $row->updated_at);
        /**
         * @var array
         */
        $supportedLocales = config('laravellocalization.supportedLocales');
        $lang = app()->getLocale();
        if ('' === $row->getAttributeValue('lang')) {
            $row->update(['lang' => $lang]);
        }

        self::__setStatic('locale', $supportedLocales[$lang]['regional']);
        // self::__setStatic('description', $row->meta_description);
        // self::__setStatic('keywords', $row->meta_keywords);
        // self::__setStatic('type', $row->post_type);
        if (method_exists($row, 'imageResizeSrc')) {
            $image_width = 200;
            $image_height = 200;
            if (! \is_object($row)) {
                throw new \Exception('['.$row.'] was not found');
            }
            $image = $row->imageResizeSrc(['width' => $image_width, 'height' => $image_height]);
            self::__setStatic('image', asset($image));
            self::__setStatic('image_width', $image_width);
            self::__setStatic('image_height', $image_height);
        }
    }

    /**
     * ---.
     */
    public static function getArea(): ?string {
        $params = getRouteParameters();
        if (isset($params['module'])) {
            return $params['module'];
        }
        /*
        $tmp = explode('/', optional(\Route::current())->getCompiled()->getStaticPrefix());
        $tmp = \array_slice($tmp, 2, 1);
        if (\count($tmp) < 1) {
            return false;
        }

        return $tmp[0];
        */
        return null;
    }

    /**
     * ---.
     */
    public static function getModels(array $params): ?array {
        extract($params);
        if (! isset($module)) {
            dddx(['err' => 'module is missing']);

            return null;
        }
        $mod = \Module::find($module);
        if (null === $mod) {
            throw new \Exception('module ['.$module.'] was not found');
        }
        $mod_path = $mod->getPath().'\Models';
        $files = File::files($mod_path);
        /**
         * @var array
         */
        $data = [];
        $ns = 'Modules\\'.$mod->getName().'\\Models';  // con la barra davanti non va il search ?
        /**
         * @var array<int,string>
         */
        $models = config('morph_map');

        // dddx($model_coll);

        foreach ($files as $file) {
            $filename = $file->getRelativePathname();
            $ext = '.php';
            if (Str::endsWith($filename, $ext)) {
                $tmp = new \stdClass();
                $name = substr($filename, 0, -\strlen($ext));
                $tmp->name = $name;
                $tmp->class = $ns.'\\'.$name;
                $tmp->type = collect($models)->search($tmp->class);
                // $tmp->name.='['.$tmp->class.']['.$tmp->type.']'; //4debug
                if ('' !== $tmp->type) {
                    if (! isset($params['lang'])) {
                        $params['lang'] = app()->getLocale();
                    }
                    $params['container0'] = $tmp->type;
                    $tmp->url = route('admin.containers.index', $params);
                    $data[] = $tmp;
                }
            }
        }

        return $data;
    }

    // end getXmlMenu

    /**
     * { item_description }.
     *
     * @return mixed
     */
    public static function route(array $params = []) {
        $params = array_merge(getRouteParameters(), $params);
        $routename = Route::currentRouteName();
        if (null === $routename) {
            throw new \Exception('$routename is null');
        }

        return url(route($routename, $params, false));
    }

    /**
     * { item_description }.
     */
    public static function getView(?array $parz = []): string {
        $params = getRouteParameters();
        $view1 = RouteService::getView().'.'.RouteService::getAct();
        $view1 = Str::replace('..', '.', $view1);

        if (inAdmin()) {
            $mod = $params['module'] ?? RouteService::getModuleName();
            $view1 = strtolower($mod.'::'.$view1);
        } else {
            $view1 = 'pub_theme::'.$view1;
        }
        // dddx(['view0' => $view, 'view1' => $view1, 'route_action' => $route_action]);
        $view1 = Str::replace('::.', '::', $view1);

        $view2 = self::getViewWithFormat($view1);
        // dddx(['view1' => $view1, 'view2' => $view2]);

        return $view2;

        // ------------ CASI PARTICOLARI -----------
        // if ('pub_theme::translation.index' == $view) {
        //    return 'theme::translation.index';
        // }
        // ---------------Panel Actions --------------------------
        /*
        $act = \Request::input('_act');
        if (null != $act) {
            $view .= '.acts.'.$act;
        }
        */

        // dddx(['view' => $view, 'view1' => $view1, 'route_action' => $route_action]);

        // return self::getViewWithFormat($view);
    }

    /**
     * @return mixed|string
     */
    public static function getViewDefault(array $params = []) {
        extract($params);
        if (! isset($act)) {
            $act = RouteService::getAct();
        }
        $view_default = 'pub_theme::layouts.default.'.$act; // pub_theme o extend ?
        if (inAdmin()) {
            $view_default = 'adm_theme::layouts.default.'.$act;
        }

        return self::getViewWithFormat($view_default);
    }

    /**
     * @return mixed|string
     */
    public static function getViewExtend(array $params = []) {
        extract($params);
        if (! isset($act)) {
            $act = RouteService::getAct();
        }
        $view_extend = 'theme::layouts.default.'.$act;
        if (inAdmin()) {
            $view_extend = 'theme::layouts.default.admin.'.$act;
        }

        return self::getViewWithFormat($view_extend);
    }

    /**
     * @return mixed|string|null
     */
    public static function getViewModule(array $params = []) {
        extract($params);

        if (! isset($act)) {
            $act = RouteService::getAct();
        }

        // [$containers,$items] = \params2ContainerItem();
        /*
        if (0 == count($containers)) {
            return null;
        }
        */
        $panel = PanelService::make()->getRequestPanel();
        if (null !== $panel) {
            $mod_name_low = $panel->getModuleNameLow();
            $panel_name_low = strtolower($panel->getName());
            $view = $mod_name_low.'::'.(inAdmin() ? 'admin.' : '').$panel_name_low.'.'.$act;

            return self::getViewWithFormat($view);
        }

        $mod_name = RouteService::getModuleName();
        $mod_name_low = strtolower($mod_name);
        $controller = RouteService::getControllerName();
        $controller = Str::replace('\\', '.', $controller);
        $controller_low = strtolower($controller);

        $view = $mod_name_low.'::'.$controller_low.'.'.$act;

        return self::getViewWithFormat($view);
    }

    /**
     * ---.
     */
    public static function getViewWithFormat(string $view): string {
        // return $view; //bypasso tutto
        /*
        if (\Request::ajax()) {
            $view .= '_ajax';
        } elseif ('iframe' == \Request::input('format')) {
            $view .= '_iframe';
        }
        */
        /**
         * @var string
         */
        $act = Request::input('_act', '');
        $act = Str::snake($act);
        if ('' !== $act) {
            $view .= '.acts.'.$act;
        }

        return $view;
    }

    /**
     * @return array
     */
    public static function getDefaultViewArray(array $params = []) {
        $view = null;
        extract($params);

        /*
        $params = getRouteParameters();
        $route_action = \Route::currentRouteAction();
        $act = Str::snake(Str::after($route_action, '@'));
        */
        $view_default = self::getViewDefault();
        $view_extend = self::getViewExtend();
        $view_module = self::getViewModule();

        // ---------------------------------------------------------------------------
        if (null === $view) {
            $params = getRouteParameters();
            $view = self::getView($params);
        }

        $view_arr = explode('::', $view);
        if (Str::startsWith($view_arr[1], 'admin.')) {
            $view_arr[1] = Str::after($view_arr[1], 'admin.');
        }
        $ns = $view_arr[0].'::'.(inAdmin() ? 'admin.' : '');
        $view_short = $ns.implode('.', \array_slice(explode('.', $view_arr[1]), -4));
        $view_short1 = $ns.implode('.', \array_slice(explode('.', $view_arr[1]), -3));
        $view_short2 = $ns.implode('.', \array_slice(explode('.', $view_arr[1]), -2));

        $view_update = str_replace('.update.acts.', '.show.acts.', $view);
        // $view_store = str_replace('.store.', '.show.', $view); ??

        $views = [$view, $view_update, $view_short, $view_short1, $view_short2, $view_module, $view_default, $view_extend];

        /*
         * forse mettere filtro per togliere se c'e' una view a null, e le view che contengono ::show
         */
        $debug = debug_backtrace();
        if (isset($debug[3]) && isset($debug[3]['file'])) {
            $caller = $debug[3];
            $mod_trad = getModTradFilepath($caller['file']);
            if (Str::endsWith($mod_trad, '_action')) {
                $mod_trad = Str::before($mod_trad, '_action');
                $mod_trad = Str::before($mod_trad, '::').'::acts.'.Str::after($mod_trad, '::');
            }
            if (inAdmin()) {
                $mod_trad = Str::before($mod_trad, '::').'::admin.'.Str::after($mod_trad, '::');
            }
            $views[] = $mod_trad;
        }

        if (isset($debug[2]) && isset($debug[2]['file'])) {
            $caller = $debug[2];
            $mod_trad = getModTradFilepath($caller['file']);
            if (Str::endsWith($mod_trad, '_action')) {
                $mod_trad = Str::before($mod_trad, '_action');
                $mod_trad = Str::before($mod_trad, '::').'::acts.'.Str::after($mod_trad, '::');
            }
            if (inAdmin()) {
                $mod_trad = Str::before($mod_trad, '::').'::admin.'.Str::after($mod_trad, '::');
            }
            $views[] = $mod_trad;
        }

        return array_unique($views);
    }

    public static function getViewWork(array $params = []): string {
        $views = self::getDefaultViewArray($params);

        $view_work = collect($views)->first(
            function ($view_check) {
                return View::exists($view_check);
            }
        );
        if (false === $view_work || null === $view_work) {
            $ddd_msg =
                [
                    'err' => 'Not Exists ..',
                    'pub_theme' => config('xra.pub_theme'),
                    'adm_theme' => config('xra.adm_theme'),
                    'view0_dir' => FileService::viewNamespaceToDir($views[0]),
                    'views' => $views,
                    // 'debug_backtrace' => debug_backtrace(),
                ];

            dddx($ddd_msg);
        }

        return $view_work;
    }

    /**
     * view.
     * Illuminate\Contracts\View\View perche' poi posso appicciare parametri con with.
     */
    public static function view(string $view = null): \Illuminate\Contracts\View\View {
        $view_work = self::getViewWork(['view' => $view]);
        if (null === $view) {
            $view = self::getView();
        }
        $route_params = getRouteParameters();
        $lang = app()->getLocale();
        $panel = PanelService::make()->getRequestPanel();
        if (null === $panel) {
            throw new \Exception('Panel does not exists');
        }
        $row = $panel->row;
        // $route_params = getRouteParameters();
        // $row_name = last($route_params);
        // if (! is_object($row) && '' != config('morph_map.'.$row)) {
        /*
        $model = config('morph_map.'.$row);
        $row = new $model();
        */
        // $row = TenantService::model($row_name);
        // }
        // }
        // $row_type = '';

        if (\is_object($row)) {
            self::setMetatags($row);
            // if (isset($row->post_type)) {
            //    $row_type = $row->post_type;
            // }
            // if (! isset($panel)) {
            // $panel = StubService::make()->setModelAndName($row, 'panel')->get();
            // }
        }
        // if ('' == $row_type) {
        //    $row_type = \Str::camel(class_basename($row));
        // }

        $routename = getRouteName();
        $route_action = \Route::currentRouteAction();

        // --- per passare la view all'interno dei componenti
        \View::composer(
            '*',
            function ($view_params) use ($view, $panel): void {
                \View::share('view', $view);
                // $trad = implode('.', array_slice(explode('.', $view), 0, -1));
                // \View::share('trad', $trad);
                \View::share('_panel', $panel);
            }
        );
        [$containers, $items] = params2ContainerItem($route_params);
        /*
        list($containers, $items) = params2ContainerItem($route_params);
        $last_container = last($containers);
        //$types = \Str::camel(\Str::plural($last_container));
        $last_item = last($items);

        [$ns,$group] = explode('::', $view);
        $group = explode('.', $group);
        $trad_short1 = $ns.'::'.implode('.', array_slice($group, -3));
        $trad_short2 = $ns.'::'.implode('.', array_slice($group, -2));

        //$trad_mod = '';

        //if(isset($group[0]) && $group[0]!='auth'){

        try {
            $trad_mod = strtolower(getModuleNameFromModelName($group[0]).'').'::'.$group[0];
        } catch (\Exception $e) {
            $trad_mod = 'xot::txt';
        }
        //}
        */

        $trad_mod = $panel->getTradMod();
        $modal = null;
        if (\Request::ajax()) {
            $modal = 'ajax';
        } elseif ('iframe' === \Request::input('format')) {
            $modal = 'iframe';
        }

        $view_params = [
            'trad_mod' => $trad_mod,
            'lang' => $lang,
            'params' => $route_params,
            'containers' => $containers,
            'last_container' => last($containers),
            'items' => $items,
            'last_item' => last($items),
            'routename' => $routename,
            // 'page' => new Objects\PageObject(), deprecated
            'modal' => $modal,
        ];

        return view()->make($view, $view_params);
    }

    /**
     * @param mixed $view
     * @param mixed $data
     * @param mixed $mergeData
     *
     * @return \Illuminate\Http\RedirectResponse|void
     */
    /* deprecated
    public static function action(Request $request, $row) {
        //echo '<pre>';print_r($routes);echo '</pre>';
        $routename = \Route::current()->getName();
        $rotename_arr = explode('.', $routename);
        $rotename_arr = array_slice($rotename_arr, 0, -1);
        $routename_base = implode('.', $rotename_arr);
        //dddx($rotename_arr);
        $params = getRouteParameters();
        $data = $request->all();
        if (! isset($data['_action'])) {
            $data['_action'] = 'save_close';
        }
        switch ($data['_action']) {
            case 'save_continue':
                //$this->routes->getByName($name)
                $routes = app('router')->getRoutes();
                $routename = $routename_base.'.edit';
                $route_info = $routes->getByName($routename);
                $pattern = '/\{([^}]+)\}/';
                preg_match_all($pattern, $route_info->uri, $matches);
                $parz = [];
                //dddx($row->guid); //deve esserci, controllare che nel modello non ci sia function getGuidAttribute, e che ci sia
                //  linkedTrait
                foreach ($matches[1] as $match) {
                    if (isset($params[$match])) {
                        $parz[$match] = $params[$match];
                    } else {
                        $parz[$match] = $row;
                    }
                }

                return redirect()->route($routename, $parz);
                //break;
            case 'save_close':
                $routename = $routename_base.'.index';
                if (\Route::has($routename.'_edit')) {
                    return redirect()->route($routename.'_edit', $params);
                }

                return redirect()->route($routename, $params);
                //break;
            case 'come_back':
                return redirect()->back();
                //break;
            case 'row':
                return $row;
                //break;
            default:
                echo '<h3>['.__LINE__.']['.__FILE__.']</h3>';
                dddx($data['_action']);
                break;
        }//end switch
    }
    */
    // end function

    /**
     * @param string $view
     * @param array  $data
     * @param array  $mergeData
     *
     * @return mixed|string
     */
    public static function cache(/* ViewContract $vc, */ $view, $data = [], $mergeData = []) {
        // scopiazzato da spatie partialcache
        $lang = app()->getLocale();
        $data['lang'] = $lang;

        $json_data = json_encode($data);
        if (! $json_data) {
            throw new \Exception('json_encod $data false');
        }

        $cache_key = Str::slug($view).'-'.md5($json_data).'-1';

        $seconds = 60 * 60 * 24;
        try {
            $html = Cache::/* store('apc')-> */ remember(
                $cache_key,
                $seconds,
                function () use ($view, $data, $mergeData) {
                    return (string) \View::make($view, $data, $mergeData)->render();
                    // return (string)self::view($view);
                }
            );
        } catch (\Exception $e) {
            ArtisanService::exe('cache:clear');
            $html = (string) \View::make($view, $data, $mergeData)->render();
        }

        return $html;
    }

    /**
     * @return bool|mixed|string|void
     */
    public static function imageSrc(array $params) {
        // DA RIFARE
        extract($params);
        if (! isset($path)) {
            dddx(['err' => 'path is missing']);

            return;
        }
        $path = self::asset($path);
        /* TO DOOOOOOOO
        */

        return $path; // ci mette troppo nel server
        // dddx($path);
        /*
        $parz = ['src' => $path, 'height' => $height, 'width' => $width];
        $img = new ImageService($parz);
        $ris = $img->fit()->save()->src();
        $ris = str_replace('\\', '/', $ris);
        $ris = str_replace('//', '/', $ris);
        dddx([
            'ris' => $ris,
            'asset ris' => asset($ris),
        ]);

        return asset($ris);
        */
    }

    /* deprecated ??
    public static function getDynViewsArray($view_tpl, $params) {
        extract($params);
        $views = [
            $_layout->view.'.'.$view_tpl.'',
            $_layout->view_default.'.'.$view_tpl.'.'.$_layout->row_type,
            $_layout->view_extend.'.'.$view_tpl.'.'.$_layout->row_type, //?incerto
            $_layout->view_default.'.'.$view_tpl.'',
            $_layout->view_extend.'.'.$view_tpl.'',
        ];

        return $views;
    }

    public static function getDynView($view_tpl, $params) {
        $views = self::getDynViewsArray($view_tpl, $params);
        //dddx($views); 4debug
        $view_first = collect($views)->first(function ($view_check) {
            return View::exists($view_check);
        });

        return $view_first;
    }
    */

    public static function include(string $view_tpl, array $params_tpl, array $vars): ?Renderable {
        $views = self::getDefaultViewArray();
        $views = collect($views)->map(
            function ($item) use ($view_tpl) {
                return $item.'.'.$view_tpl;
            }
        );
        $view_work = $views->first(
            function ($view_check) {
                return View::exists($view_check);
            }
        );

        if (null === $view_work) {
            if (\in_array($view_tpl, ['topbar', 'bottombar', 'inner_page'], true)) {
                return null;
                // throw new \Exception('$view_work is null');
            }

            dddx(['err' => 'view not Exists', 'views' => $views]);
        }

        $view_params = array_merge($vars, $params_tpl);

        if (null === $view_work) {
            throw new \Exception('$view_work is null');
        }

        return view()->make($view_work, $view_params);
        // return view($view_work)->with($vars)->with($params_tpl); // quale delle 2 ?
        // return (string)\View::make($view_work, $params_tpl, $vars)->render();
    }

    /*
    //--- lo chiamo da blade, in prod si puo' ipotizzare di usare la cache
    public static function include_old($view_tpl, $params_tpl, $vars) {
        extract($vars);
        $view_first = self::getDynView($view_tpl, $vars);
        if ('' == $view_first) {
            $views = self::getDynViewsArray($view_tpl, $vars);
            echo '<h3 style="text:#d60021;">--NOT EXISTS--</h3>';
            //dddx('not exists ['.implode(']'.chr(13).'[',$views).']');
            dddx($views);
        }

        return view()->make($view_first)->with($vars)->with($params_tpl); // quale delle 2 ?
                // return (string)\View::make($view_check, $params_tpl, $vars)->render();
    }
    */

    /**
     * @param string $name
     *
     * @return mixed
     */
    public static function xotModelEager($name) {
        return TenantService::modelEager($name);
    }

    /**
     * @param string $name
     *
     * @return array|false|mixed
     */
    public static function xotModel($name) {
        return TenantService::model($name);
    }

    /**
     * Undocumented function.
     */
    public static function panelModel(Model $model): PanelContract {
        $class = StubService::make()->setModelAndName($model, 'panel')->get();
        $panel = app($class)->setRow($model);

        return $panel;
    }

    public static function inputFreeze(FieldData $field, Model $row): Renderable {
        return FormService::inputFreeze($field, $row);
    }

    /**
     * Undocumented function.
     *
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Support\HtmlString
     */
    public static function inputHtml(array $params) {
        return FormService::inputHtml($params);
    }

    public static function getAdminJsonMenu(): void {
        $route_params = getRouteParameters();
        extract($route_params);
        if (! isset($module)) {
            dddx(['err' => 'module is missing']);

            return;
        }
        if (Str::startsWith($module, 'trasferte')) {
            $module_original = 'trasferte';
        } else {
            $module_original = $module;
        }
        $mod = \Module::find($module_original);
        if (null === $mod) {
            throw new \Exception('module ['.$module_original.'] was not found');
        }
        $mod_path = $mod->getPath();
        $json_path = $mod_path.'/_menuxml/admin/'.$module.'/_menufull.php';
        // \Debugbar::addMessage($json_path, 'menu path:');
        $json_path = str_replace(['\\', '/'], [\DIRECTORY_SEPARATOR, \DIRECTORY_SEPARATOR], $json_path);
        $menu = include $json_path;
        dddx($menu);
        /*
        $json_content=File::get($json_path);
        $json=json_decode($json_content);
        dddx($json);
        */
    }

    /**
     * @return array|mixed
     */
    public static function getXmlMenu() {
        $route_params = getRouteParameters();
        extract($route_params);
        if (! isset($module)) {
            return [];
        }
        if (Str::startsWith($module, 'trasferte')) {
            $module_original = 'trasferte';
        } else {
            $module_original = $module;
        }
        $mod = \Module::find($module_original);
        if (null === $mod) {
            throw new \Exception('module ['.$module_original.'] was not found');
        }
        $mod_path = $mod->getPath();
        $json_path = $mod_path.'/_menuxml/admin/'.$module.'/_menufull.php';
        // \Debugbar::addMessage($json_path, 'menu path:');
        $json_path = str_replace(['\\', '/'], [\DIRECTORY_SEPARATOR, \DIRECTORY_SEPARATOR], $json_path);
        if (! File::exists($json_path)) {
            return [];
        }
        $menu = include $json_path;

        return $menu;
    }

    /**
     * @return string
     */
    public static function getPath() {
        // da jigsaw
        return 'to do';
    }

    /**
     * @param string $scope
     * @param string $name
     * @param mixed  $value
     */
    public static function addAttr($scope, $name, $value): void {
        self::$attrs[$scope][$name] = $value;
    }

    /**
     * @param string $scope
     * @param string $class
     */
    public static function addClass($scope, $class): void {
        self::$classes[$scope][] = $class;
    }

    /**
     * @param string $scope
     */
    public static function printAttrs($scope): void {
        $attrs = [];

        if (isset(self::$attrs[$scope]) && ! empty(self::$attrs[$scope])) {
            foreach (self::$attrs[$scope] as $name => $value) {
                $attrs[] = $name.'="'.$value.'"';
            }
            echo ' '.implode(' ', $attrs).' ';
        }
        echo '';
    }

    /**
     * @param string $scope
     * @param bool   $full
     */
    public static function printClasses($scope, $full = true): void {
        if ('body' === $scope) {
            self::$classes[$scope][] = 'page-loading';
        }

        if (isset(self::$classes[$scope]) && ! empty(self::$classes[$scope])) {
            $classes = implode(' ', self::$classes[$scope]);
            if ($full) {
                echo ' class="'.$classes.'" ';
            } else {
                echo ' '.$classes.' ';
            }
        } else {
            echo '';
        }
    }

    /**
     * Prints Google Fonts.
     */
    public static function getGoogleFontsInclude(): void {
        if (TenantService::config('layout.resources.fonts.google.families')) {
            $fonts = TenantService::config('layout.resources.fonts.google.families');
            if (! \is_array($fonts)) {
                $fonts = [];
            }
            echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family='.implode('|', $fonts).'">';
        }
        echo '';
    }

    /**
     * Walk recursive array with callback.
     *
     * @return array
     */
    public static function arrayWalkCallback(array &$array, callable $callback) {
        foreach ($array as $k => &$v) {
            if (\is_array($v)) {
                $callback($k, $v, $array);
                self::arrayWalkCallback($v, $callback);
            }
        }

        return $array;
    }

    /**
     * Convert css file path to RTL file.
     *
     * @param string $css_path
     *
     * @return string|string[]
     */
    public static function rtlCssPath($css_path) {
        $css_path = substr_replace($css_path, '.rtl.css', -4);

        return $css_path;
    }

    /**
     * Initialize theme CSS files.
     *
     * @return array
     */
    /* metronic ?
    public static function initThemes() {
        $themes = [];


        //$themes[] = 'css/themes/layout/header/base/'.TenantService::config('layout.header.self.theme').'.css';
        //$themes[] = 'css/themes/layout/header/menu/'.TenantService::config('layout.header.menu.desktop.submenu.theme').'.css';
        //$themes[] = 'css/themes/layout/aside/'.TenantService::config('layout.aside.self.theme').'.css';

        $themes[] = self::asset('adm_theme::dist/css/themes/layout/header/base/'.TenantService::config('layout.header.self.theme').'.css');
        $themes[] = self::asset('adm_theme::dist/css/themes/layout/header/menu/'.TenantService::config('layout.header.menu.desktop.submenu.theme').'.css');
        $themes[] = self::asset('adm_theme::dist/css/themes/layout/aside/'.TenantService::config('layout.aside.self.theme').'.css');

        if (TenantService::config('layout.aside.self.display')) {
            $themes[] = self::asset('adm_theme::dist/css/themes/layout/brand/'.TenantService::config('layout.brand.self.theme').'.css');
        } else {
            $themes[] = self::asset('adm_theme::dist/css/themes/layout/brand/'.TenantService::config('layout.header.self.theme').'.css');
        }

        return $themes;
    }
    */

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public static function tenantConfig(string $config) {
        return TenantService::config($config);
    }

    /**
     * @param array      $item
     * @param array|null $parent
     * @param int        $rec
     *
     * @return string|void
     */
    public static function renderVerMenu($item, $parent = null, $rec = 0, bool $singleItem = false) {
        return MenuService::renderVerMenu($item, $parent, $rec, $singleItem);
    }

    /**
     * @param array      $item
     * @param array|null $parent
     * @param int        $rec
     *
     * @return string|void
     */
    public static function renderHorMenu($item, $parent = null, $rec = 0, bool $singleItem = false) {
        return MenuService::renderHorMenu($item, $parent, $rec); // ??, $singleItem
    }

    // Render icon or bullet
    public static function renderIcon(?string $icon = ''): string {
        if (null === $icon) {
            // throw new \Exception('icon not exists in config icons file ['.__LINE__.']['.__FILE__.']');
            return '<i class="menu-icon"></i>';
        }
        if (SvgService::isSVG($icon)) {
            return (string) SvgService::getSVG($icon, 'menu-icon').'';
        }

        return '<i class="menu-icon '.$icon.'"></i>';
    }

    /**
     * Undocumented function.
     */
    public static function renderIconName(string $icon_name): string {
        $icon_key = 'icons.'.$icon_name;
        $icon = TenantService::config($icon_key);
        if (! \is_string($icon)) {
            // dddx($icon_name);
            throw new \Exception('icon not exists in config icons file ['.__LINE__.']['.__FILE__.']');
        }
        // forse conviene inserire un controllo per verificare che si trovi la corrispondente chiave della lingua
        // esempio es per spagnolo, nell'array di laravel\config\4venti-local\icons.php
        // ho dovuto aggiungere la riga 'es' => 'media/svg/flags/128-spain.svg', per visualizzare il pannello admin
        // dddx(['icon_name' => $icon_name, 'icon' => $icon, 'icon_key' => $icon_key, 'result' => self::renderIcon($icon)]);

        return self::renderIcon($icon);
    }

    /**
     * Undocumented function.
     */
    public static function getSVG(string $filepath = '', string $class = ''): string {
        return (string) SvgService::getSVG($filepath, $class);
    }

    public static function getThemeType(string $theme_type): string {
        $xot = config('xra');
        if (! \is_array($xot)) {
            // throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
            $xot = [];
        }
        if (! isset($xot[$theme_type])) {
            $xot[$theme_type] = self::firstThemeName($theme_type);
            // throw new Exception('[' . __LINE__ . '][' . class_basename(__CLASS__) . ']');
            TenantService::saveConfig(['name' => 'xra', 'data' => $xot]);
        }
        $theme = $xot[$theme_type];

        return $theme;
    }

    public static function getThemes(): Collection {
        $themes_dir = base_path('Themes');
        if (! File::exists($themes_dir)) {
            // throw new \Exception('Themes directory do not exits ['.$themes_dir.']['.__LINE__.']['.__FILE__.']');
            return collect([]);
        }
        $themes = File::directories($themes_dir);
        $default_data = [
            'name' => 'name',
            'type' => 'adm',
            'description' => '',
            'keywords' => [],
            'active' => 1,
            'order' => 0,
            'aliases' => (object) [],
            'files' => [],
            'requires' => [],
        ];

        $themes = collect($themes)->map(
            function ($item) use ($default_data) {
                $file_json = $item.\DIRECTORY_SEPARATOR.'theme.json';
                if (! File::exists($file_json)) {
                    $default_data['name'] = basename($item);
                    $data = json_encode($default_data);
                    if ($data) {
                        File::put($file_json, $data);
                    }
                }
                $json = (array) json_decode(File::get($file_json), true);
                $json['name'] = basename($item);
                $json['path'] = $item;
                $json = array_merge($default_data, $json);
                // $info = pathinfo($item);

                return collect($json)->map(
                    function ($item) {
                        if (! \is_string($item)) {
                            return json_encode($item);
                        }

                        return $item;
                    }
                )
                    ->all();
            }
        );

        return $themes;
    }

    public static function themeScreenshot(string $name): string {
        $img = 'Themes\\'.$name.'\screenshot.jpg';
        $img_low = strtolower($img);
        $from = base_path($img);
        $to = public_path($img_low);
        $asset = asset(str_replace(['/', '\\'], ['/', '/'], $img_low));
        if (Str::startswith($asset, url(''))) {
            $asset = Str::after($asset, url(''));
        }
        if (! File::exists($to)) {
            File::makeDirectory(\dirname($to), 0755, true, true);
            File::copy($from, $to);
        }

        return $asset;
    }

    public static function firstThemeName(string $theme_type): string {
        // 1487   Undefined variable: $this
        /*
        if ($this->app->runningInConsole()) {
            return '';
        }
        */
        $themes = self::getThemes();

        $type = Str::before($theme_type, '_theme');
        /**
         * @var array|null
         */
        $theme = $themes->firstWhere('type', $type);

        if (null === $theme /* || $theme->isEmpty() */) {
            throw new \Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }

        return $theme['name'];

        /*
        if ('adm_theme' == $theme_type) {
            return $themes->firstWhere('type', 'adm')['name'];
        }

        return $themes->firstWhere('type', 'pub')['name'];
        */
    }
}// end class

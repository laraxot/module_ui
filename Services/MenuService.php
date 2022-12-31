<?php

declare(strict_types=1);

namespace Modules\UI\Services;

use Illuminate\Support\Facades\File;
use Modules\Tenant\Services\TenantService;

// ----- Models -----

// ---- xot extend -----
// ----- services --

// ---------CSS------------

/**
 * Class MenuService.
 */
class MenuService {
    /**
     * @return array|mixed
     */
    public static function get() {
        $route_params = getRouteParameters();
        extract($route_params);
        if (! isset($module)) {
            return [];
        }

        $module_original = $module;

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
     * @param array|null $item
     * @param array|null $parent
     * @param int        $rec
     * @param bool       $singleItem
     *
     * @return string|void
     */
    public static function renderVerMenu($item, $parent = null, $rec = 0, $singleItem = false) {
        $html = '';
        self::checkRecursion($rec);
        if (! $item) {
            // return '<div>menu misconfiguration</div>';

            return '<div></div>';
        }

        if (isset($item['separator'])) {
            $html .= '<li class="menu-separator"><span></span></li>';
        } elseif (isset($item['section'])) {
            $html .= '<li class="menu-section '.(0 === $rec ? 'menu-section--first' : '').'">
                <h4 class="menu-text">'.$item['section'].'</h4>
                <i class="menu-icon flaticon-more-v2"></i>
            </li>';
        } elseif (isset($item['title'])) {
            $item_class = '';
            $item_attr = '';

            if (isset($item['submenu'])) {
                $item_class .= ' menu-item-submenu'; // m-menu__item--active

                if (isset($item['toggle']) && 'click' === $item['toggle']) {
                    $item_attr .= ' data-menu-toggle="click"';
                } else {
                    $item_attr .= ' data-menu-toggle="hover"';
                }

                if (isset($item['mode'])) {
                    $item_attr .= ' data-menu-mode="'.$item['mode'].'"';
                }

                if (isset($item['dropdown-toggle-class'])) {
                    $item_attr .= ' data-menu-toggle-class="'.$item['dropdown-toggle-class'].'"';
                }
            }

            if (true === @$item['redirect']) {
                $item_attr .= ' data-menu-redirect="1"';
            }

            // parent item for hoverable submenu
            if (isset($item['parent'])) {
                $item_class .= ' menu-item-parent'; // m-menu__item--active
            }

            // custom class for menu item
            if (isset($item['custom-class'])) {
                $item_class .= ' '.$item['custom-class'];
            }

            if (isset($item['submenu']) && self::isActiveVerMenuItem($item, request()->path())) {
                $item_class .= ' menu-item-open menu-item-here'; // m-menu__item--active
            } elseif (self::isActiveVerMenuItem($item, request()->path())) {
                $item_class .= ' menu-item-active';
            }

            $html .= '<li class="menu-item '.$item_class.'" aria-haspopup="true" '.$item_attr.'>';
            if (isset($item['parent'])) {
                $html .= '<span class="menu-link">';
            } else {
                $url = '#';

                if (isset($item['page'])) {
                    $url = url($item['page']);
                }

                $target = '';
                if (isset($item['new-tab']) && true === $item['new-tab']) {
                    $target = 'target="_blank"';
                }

                $html .= '<a '.$target.' href="'.$url.'" class="menu-link '.(isset($item['submenu']) ? 'menu-toggle' : '').'">';
            }

            // Menu arrow
            if (true === @$item['here']) {
                $html .= '<span class="menu-item-here"></span>';
            }

            // bullet
            $bullet = '';

            if (null !== $parent && isset($parent['bullet']) && 'dot' === $parent['bullet']) {
                $bullet = 'dot';
            } elseif (null !== $parent && isset($parent['bullet']) && 'line' === $parent['bullet']) {
                $bullet = 'line';
            }

            // Menu icon OR bullet
            if ('dot' === $bullet) {
                $html .= '<i class="menu-bullet menu-bullet-dot"><span></span></i>';
            } elseif ('line' === $bullet) {
                $html .= '<i class="menu-bullet menu-bullet-line"><span></span></i>';
            } elseif (true !== config('layout.aside.menu.hide-root-icons') && isset($item['icon']) && ! empty($item['icon'])) {
                $html .= ThemeService::renderIcon($item['icon']);
            }

            // Badge
            $html .= '<span class="menu-text">'.$item['title'].'</span>';
            if (isset($item['label'])) {
                $html .= '<span class="menu-badge"><span class="label '.$item['label']['type'].'">'.$item['label']['value'].'</span></span>';
            }

            if (true === $singleItem) {
                if (isset($item['parent'])) {
                    $html .= '</span>';
                } else {
                    $html .= '</a>';
                }

                $html .= '</li>';

                return;
            }

            if (isset($item['submenu'])) {
                if (false === isset($item['root']) && 'plus-minus' === config('layout.menu.aside.submenu.arrow')) {
                    $html .= '<i class="menu-arrow menu-arrow-pm"><span><span></span></span></i>';
                } elseif (false === isset($item['root']) && 'plus-minus-square' === config('layout.menu.aside.submenu.arrow')) {
                    $html .= '<i class="menu-arrow menu-arrow-pm-square"><span><span></span></span></i>';
                } elseif (false === isset($item['root']) && 'plus-minus-circle' === config('layout.menu.aside.submenu.arrow')) {
                    $html .= '<i class="menu-arrow menu-arrow-pm-circle"><span><span></span></span></i>';
                } else {
                    if (false !== @$item['arrow'] && false !== config('layout.aside.menu.root-arrow')) {
                        $html .= '<i class="menu-arrow"></i>';
                    }
                }
            }

            if (isset($item['parent'])) {
                $html .= '</span>';
            } else {
                $html .= '</a>';
            }

            if (isset($item['submenu'])) {
                $submenu_dir = '';
                if (isset($item['submenu-up']) && true === $item['submenu-up']) {
                    $submenu_dir = 'menu-submenu-up';
                }
                $html .= '<div class="menu-submenu '.$submenu_dir.'">';
                $html .= '<span class="menu-arrow"></span>';

                if (isset($item['custom-class']) && ('menu-item-submenu-stretch' === $item['custom-class'] || 'menu-item-submenu-scroll' === $item['custom-class'])) {
                    $html .= '<div class="menu-wrapper">';
                }

                if (isset($item['scroll'])) {
                    $html .= '<div class="menu-scroll" data-scroll="true" style="height: '.$item['scroll'].'">';
                }

                $html .= '<ul class="menu-subnav">';
                if (isset($item['root'])) {
                    $parent_item = $item;
                    $parent_item['parent'] = true;
                    unset($parent_item['icon'], $parent_item['submenu']);

                    $html .= optional(self::renderVerMenu($parent_item, null, $rec++, true)); // single item render
                }
                foreach ($item['submenu'] as $submenu_item) {
                    $html .= self::renderVerMenu($submenu_item, $item, $rec++);
                }
                $html .= '</ul>';

                if (isset($item['scroll']) || isset($item['custom-class']) && 'menu-item-submenu-stretch' === $item['custom-class']) {
                    $html .= '</div>';
                }
                $html .= '</div>';
            }

            $html .= '</li>';
        } else {
            foreach ($item as $each) {
                $html .= self::renderVerMenu($each, $parent, $rec++);
            }
        }

        return $html;
    }

    /**
     * @return string|void
     */
    public static function renderHorMenu(array $item, ?array $parent = null, int $rec = 0) {
        self::checkRecursion($rec);
        if (! $item) {
            return 'menu misconfiguration';
        }

        // render separator
        if (isset($item['separator'])) {
            echo '<li class="menu-separator"><span></span></li>';
        } elseif (isset($item['title']) || isset($item['code'])) {
            $item_class = '';
            $item_attr = '';

            if (isset($item['submenu']) && self::isActiveHorMenuItem($item, request()->path())) {
                $item_class .= ' menu-item-open menu-item-here'; // m-menu__item--active

                if ('tabs' === @$item['submenu']['type']) {
                    $item_class .= ' menu-item-active-tab ';
                }
            } elseif (self::isActiveHorMenuItem($item, request()->path())) {
                $item_class .= ' menu-item-active ';

                if ('tabs' === @$item['submenu']['type']) {
                    $item_class .= ' menu-item-active-tab ';
                }
            }

            if (isset($item['submenu'])) {
                $item_class .= ' menu-item-submenu'; // m-menu__item--active

                if (isset($item['toggle']) && 'click' === $item['toggle']) {
                    $item_attr .= ' data-menu-toggle="click"';
                } elseif ('tabs' === @$item['submenu']['type']) {
                    $item_attr .= ' data-menu-toggle="tab"';
                } else {
                    $item_attr .= ' data-menu-toggle="hover"';
                }
            }

            if (true === @$item['redirect']) {
                $item_attr .= ' data-menu-redirect="1"';
            }

            if (isset($item['submenu'])) {
                if (! isset($item['submenu']['type'])) {
                    // default option
                    $item['submenu']['type'] = 'classic';
                    $item['submenu']['alignment'] = 'right';
                }
                if (('classic' === $item['submenu']['type']) && isset($item['root'])) {
                    $item_class .= ' menu-item-rel';
                }

                if (('mega' === $item['submenu']['type']) && isset($item['root']) && 'center' !== @$item['align']) {
                    $item_class .= ' menu-item-rel';
                }

                if ('tabs' === $item['submenu']['type']) {
                    $item_class .= ' menu-item-tabs';
                }
            }

            if (isset($item['submenu']['items']) && self::isActiveHorMenuItem($item['submenu'], request()->path())) {
                $item_class .= ' menu-item-open menu-item-here'; // m-menu__item--active
            }

            if (isset($item['custom-class'])) {
                $item_class .= ' '.$item['custom-class'];
            }

            if (true === @$item['icon-only']) {
                $item_class .= ' menu-item-icon-only';
            }

            if (false === isset($item['heading'])) {
                echo '<li class="menu-item '.$item_class.'" '.$item_attr.' aria-haspopup="true">';
            }

            // check if code is provided instead of link
            if (isset($item['code'])) {
                echo $item['code'];
            } else {
                // insert title or heading
                if (false === isset($item['heading'])) {
                    $url = '#';

                    if (isset($item['page'])) {
                        $url = url($item['page']);
                    }

                    $target = '';
                    if (isset($item['new-tab']) && true === $item['new-tab']) {
                        $target = 'target="_blank"';
                    }

                    echo '<a '.$target.' href="'.$url.'" class="menu-link '.(isset($item['submenu']) ? 'menu-toggle' : '').'">';
                } else {
                    echo '<h3 class="menu-heading menu-toggle">';
                }

                // put root level arrow
                if (true === @$item['here']) {
                    echo '<span class="menu-item-here"></span>';
                }

                // bullet
                $bullet = '';

                if (isset($parent['bullet'])) {
                    if ((@$item['heading'] && 'dot' === @$item['bullet']) || 'dot' === @$parent['bullet']) {
                        $bullet = 'dot';
                    } elseif ((@$item['heading'] && 'line' === @$item['bullet']) || 'line' === @$parent['bullet']) {
                        $bullet = 'line';
                    }
                }

                // Menu icon OR bullet
                if ('dot' === $bullet) {
                    echo '<i class="menu-bullet menu-bullet-dot"><span></span></i>';
                } elseif ('line' === $bullet) {
                    echo '<i class="menu-bullet menu-bullet-line"><span></span></i>';
                } elseif (isset($item['icon']) && ! empty($item['icon'])) {
                    self::renderIcon($item['icon']);
                }

                // Badge
                echo '<span class="menu-text">'.$item['title'].'</span>';
                if (isset($item['label'])) {
                    echo '<span class="menu-badge"><span class="label '.$item['label']['type'].'">'.$item['label']['value'].'</span></span>';
                }
                // Arrow
                if (isset($item['submenu']) && (! isset($item['arrow']) || false !== $item['arrow'])) {
                    // root down arrow
                    if (isset($item['root'])) {
                        // enable/disable root arrow
                        if (false !== config('layout.header.menu.self.root-arrow')) {
                            echo '<i class="menu-hor-arrow"></i>';
                        }
                    } else {
                        // inner menu arrow
                        echo '<i class="menu-hor-arrow"></i>';
                    }
                    echo '<i class="menu-arrow"></i>';
                }

                // closing title or heading
                if (false === isset($item['heading'])) {
                    echo '</a>';
                } else {
                    echo '<i class="menu-arrow"></i></h3>';
                }

                if (isset($item['submenu'])) {
                    $submenu_class = '';
                    if (\in_array($item['submenu']['type'], ['classic', 'tabs'], true)) {
                        if (isset($item['submenu']['alignment'])) {
                            $submenu_class = ' menu-submenu-'.$item['submenu']['alignment'];

                            if (isset($item['submenu']['pull']) && true === $item['submenu']['pull']) {
                                $submenu_class .= ' menu-submenu-pull';
                            }
                        }

                        if ('tabs' === $item['submenu']['type']) {
                            $submenu_class .= ' menu-submenu-tabs';
                        }

                        echo '<div class="menu-submenu menu-submenu-classic'.$submenu_class.'">';

                        echo '<ul class="menu-subnav">';
                        $items = [];
                        if (isset($item['submenu']['items'])) {
                            $items = $item['submenu']['items'];
                        } else {
                            $items = $item['submenu'];
                        }
                        foreach ($items as $submenu_item) {
                            self::renderHorMenu($submenu_item, $item, $rec++);
                        }
                        echo '</ul>';
                        echo '</div>';
                    } elseif ('mega' === $item['submenu']['type']) {
                        $submenu_fixed_width = '';

                        if ((int) (@$item['submenu']['width']) > 0) {
                            $submenu_class = ' menu-submenu-fixed';
                            $submenu_fixed_width = 'style="width:'.$item['submenu']['width'].'"';
                        } else {
                            $submenu_class = ' menu-submenu-'.$item['submenu']['width'];
                        }

                        if (isset($item['submenu']['alignment'])) {
                            $submenu_class .= ' menu-submenu-'.$item['submenu']['alignment'];

                            if (isset($item['submenu']['pull']) && true === $item['submenu']['pull']) {
                                $submenu_class .= ' menu-submenu-pull';
                            }
                        }

                        echo '<div class="menu-submenu '.$submenu_class.'" '.$submenu_fixed_width.'>';

                        echo '<div class="menu-subnav">';
                        echo '<ul class="menu-content">';
                        foreach ($item['submenu']['columns'] as $column) {
                            $item_class = '';
                            // mega menu column header active
                            if (isset($column['items']) && self::isActiveVerMenuItem($column, request()->path())) {
                                $item_class .= ' menu-item-open menu-item-here'; // m-menu__item--active
                            }

                            echo '<li class="menu-item '.$item_class.'">';
                            if (isset($column['heading'])) {
                                self::renderHorMenu($column['heading'], null, $rec++);
                            }
                            echo '<ul class="menu-inner">';
                            foreach ($column['items'] as $column_submenu_item) {
                                self::renderHorMenu($column_submenu_item, $column, $rec++);
                            }
                            echo '</ul>';
                            echo '</li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }

            if (false === isset($item['heading'])) {
                echo '</li>';
            }
        } elseif (\is_array($item)) {
            foreach ($item as $each) {
                self::renderHorMenu($each, $parent, $rec++);
            }
        }
    }

    // Checks recursion depth

    /**
     * @param int $rec
     * @param int $max
     */
    public static function checkRecursion($rec = 0, $max = 10000): void {
        if ($rec > $max) {
            echo 'Too many recursions!!!';
            exit;
        }
    }

    // Check for active Vertical Menu item

    /**
     * @param array  $item
     * @param string $page
     * @param int    $rec
     *
     * @return bool
     */
    public static function isActiveVerMenuItem($item, $page, $rec = 0) {
        if (true === @$item['redirect']) {
            return false;
        }

        self::checkRecursion($rec);

        if (isset($item['page']) && $item['page'] === '/'.$page) {
            return true;
        }

        if (\is_array($item)) {
            foreach ($item as $each) {
                if (self::isActiveVerMenuItem($each, $page, $rec++)) {
                    return true;
                }
            }
        }

        return false;
    }

    // Check for active Horizontal Menu item

    /**
     * @param array  $item
     * @param string $page
     * @param int    $rec
     *
     * @return bool
     */
    public static function isActiveHorMenuItem($item, $page, $rec = 0) {
        // dddx([$item, $page, $rec]);
        if (true === @$item['redirect']) {
            return false;
        }

        self::checkRecursion($rec);

        if (isset($item['page']) && $item['page'] === $page) {
            return true;
        }

        if (\is_array($item)) {
            foreach ($item as $each) {
                if (self::isActiveHorMenuItem($each, $page, $rec++)) {
                    return true;
                }
            }
        }

        return false;
    }

    // Render icon or bullet

    public static function renderIcon(string $icon): string {
        if (SvgService::isSVG($icon)) {
            return SvgService::getSVG($icon, 'menu-icon');
        } else {
            return '<i class="menu-icon '.$icon.'"></i>';
        }
    }

    /**
     * @param string $icon_name
     *
     * @return string
     */
    public static function renderIconName($icon_name) {
        $icon_key = 'icons.'.$icon_name;
        $icon = TenantService::config($icon_key);
        // dddx(['icon' => $icon, 'name' => 'icon_key'.$icon_key]);
        if (! \is_string($icon)) {
            throw new \Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }

        return self::renderIcon($icon);
    }
}

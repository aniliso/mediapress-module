<?php

namespace Modules\Mediapress\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Sidebar\AbstractAdminSidebar;

class RegisterMediapressSidebar extends AbstractAdminSidebar
{
    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('mediapress::mediapress.title.mediapress'), function (Item $item) {
                $item->icon('fa fa-globe');
                $item->weight(10);
                $item->authorize(
                    $this->auth->hasAccess('mediapress.media.index')
                );
                $item->item(trans('mediapress::media.title.media'), function (Item $item) {
                    $item->icon('fa fa-globe');
                    $item->weight(0);
                    $item->append('admin.mediapress.media.create');
                    $item->route('admin.mediapress.media.index');
                    $item->authorize(
                        $this->auth->hasAccess('mediapress.media.index')
                    );
                });
                $item->item(trans('mediapress::category.title.category'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(1);
                    $item->append('admin.mediapress.category.create');
                    $item->route('admin.mediapress.category.index');
                    $item->authorize(
                        $this->auth->hasAccess('mediapress.categories.index')
                    );
                });
                $item->item(trans('mediapress::brand.title.brands'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(2);
                    $item->append('admin.mediapress.brand.create');
                    $item->route('admin.mediapress.brand.index');
                    $item->authorize(
                        $this->auth->hasAccess('mediapress.brands.index')
                    );
                });
            });
        });

        return $menu;
    }
}

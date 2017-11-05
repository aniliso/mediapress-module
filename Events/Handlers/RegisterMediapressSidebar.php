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
                $item->append('admin.mediapress.media.create');
                $item->route('admin.mediapress.media.index');
                $item->authorize(
                    $this->auth->hasAccess('mediapress.media.create')
                );
            });
        });

        return $menu;
    }
}

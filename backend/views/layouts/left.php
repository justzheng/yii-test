<?php
function _sidebarShow($permission_name)
{
    return Yii::$app->user->can($permission_name);
}
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username;?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header'],'visible' => Yii::$app->user->can('权限管理员')],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],'visible' => Yii::$app->user->can('权限管理员')],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],'visible' => Yii::$app->user->can('权限管理员')],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'visible' => Yii::$app->user->can('权限管理员')
                    ],
                    [
                        'label' => 'test控制器权限测试',
                        'icon' => 'fa fa-newspaper-o',
                        'items' => [
                            'test-index' => ['label' => 'test的index', 'icon' => 'fa fa-circle-o', 'url' => ['/test/test']],
                            'test-test' => ['label' => 'test的test', 'icon' => 'fa fa-circle-o', 'url' => ['/test/composer']],
                        ],
                    ],
                    [
                        'label' => '权限控制',
                        'icon' => 'fa fa-newspaper-o',
                        'items' => [
                            'route' => ['label' => '路由', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/route']],
                            'permission' => ['label' => '权限', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/permission']],
                            'role' => ['label' => '角色', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/role']],
                            'assignment' => ['label' => '分配权限', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/assignment']],
                        ],
                        'visible' => Yii::$app->user->can('权限管理员')
                    ],
                    [
                        'label' => '文件导入',
                        'icon' => 'fa fa-newspaper-o',
                        'items' => [
                            'import' => ['label' => 'excel导入', 'icon' => 'fa fa-circle-o', 'url' => ['/test/import']],
                        ],
                    ],
                    'as access' => [
                        'class' => 'mdm\admin\components\AccessControl',
                        'allowActions' => [
//                'site/*',//允许访问的节点，可自行添加
                            'admin/*',//允许所有人访问admin节点及其子节点
                            'test/*'
                        ]
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>

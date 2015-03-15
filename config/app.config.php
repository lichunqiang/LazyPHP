<?php
$GLOBALS['config']['site_name'] = 'Mugen';
$GLOBALS['config']['site_domain'] = 'lazyphp3.sinaapp.com';
$GLOBALS['config']['site_icon'] = image('lazyphplogowithoutname.128.png');

$GLOBALS['config']['assets_version'] = '20150102';

//Mugen知识入门左侧导航数据
$GLOBALS['config']['portal_nav'] = array(
    array(
        'parent' => 'Mugen入门',
        'link' => '?a=portal',
        'children' => array(
            array('id' => 1, 'label' => 'Mugen是什么？'),
            array('id' => 2, 'label' => '如何添加人物包？'),
            array('id' => 3, 'label' => '如何添加场景？'),
            array('id' => 4, 'label' => '如何更换选人界面？'),
            array('id' => 5, 'label' => '如何更换血条？'),
            array('id' => 6, 'label' => '如何更换AI人物？'),
            array('id' => 7, 'label' => '如何更换人物P数'),
        ),
    ),
    array(
        'parent' => '人物制作教程',
        'link' => '?a=portal',
        'children' => array(
            array('id' => 1, 'label' => 'Mugen是什么？'),
            array('id' => 2, 'label' => '如何添加人物包？'),
            array('id' => 3, 'label' => '如何添加场景？'),
            array('id' => 4, 'label' => '如何更换选人界面？'),
            array('id' => 5, 'label' => '如何更换血条？'),
            array('id' => 6, 'label' => '如何更换AI人物？'),
            array('id' => 7, 'label' => '如何更换人物P数'),
        ),
    ),
    array(
        'parent' => 'AI制作教程',
        'link' => '?a=portal',
        'children' => array(
            array('id' => 1, 'label' => 'Mugen是什么？'),
            array('id' => 2, 'label' => '如何添加人物包？'),
            array('id' => 3, 'label' => '如何添加场景？'),
            array('id' => 4, 'label' => '如何更换选人界面？'),
            array('id' => 5, 'label' => '如何更换血条？'),
            array('id' => 6, 'label' => '如何更换AI人物？'),
            array('id' => 7, 'label' => '如何更换人物P数'),
        ),
    ),
    array(
        'parent' => 'AI技术交流',
        'link' => '?a=skills',
    ),
);
//
$GLOBALS['config']['fgt_nav'] = array(
    array(
        'parent' => 'SNK',
        'link' => '?c=resource&a=ftg',
        'children' => array(
            array('id' => 1, 'label' => '拳皇97'),
            array('id' => 2, 'label' => '拳皇98'),
            array('id' => 3, 'label' => '侍魂2'),
            array('id' => 4, 'label' => '侍魂3'),
            array('id' => 5, 'label' => '月华剑士'),
        ),
    ),
    array(
        'parent' => 'Capcom',
        'link' => '?c=resource&a=ftg',
        'children' => array(
            array('id' => 1, 'label' => '街霸3'),
            array('id' => 2, 'label' => '街霸4'),
        ),
    ),
    array(
        'parent' => 'Arc',
        'link' => '?c=resource&a=ftg',
        'children' => array(
            array('id' => 1, 'label' => '罪恶装备'),
            array('id' => 2, 'label' => '北斗神拳'),
            array('id' => 3, 'label' => '战国basara x'),
            array('id' => 4, 'label' => '女神异闻录'),
        ),
    ),
    array(
        'parent' => '北方格斗',
        'link' => '?c=resource&a=ftg',
        'children' => array(
            array('id' => 1, 'label' => '绯想天则'),
            array('id' => 2, 'label' => '绯想天'),
            array('id' => 3, 'label' => '心倚楼'),
        ),
    ),
    array(
        'parent' => '其他',
        'link' => '?c=resource&a=ftg',
        'children' => array(
            array('id' => 1, 'label' => '电击文库格斗巅峰'),
            array('id' => 2, 'label' => 'Melty Blood(妖姬格斗)'),
            array('id' => 3, 'label' => '大番长'),
            array('id' => 4, 'label' => '大番长R'),
            array('id' => 5, 'label' => '先锋公主'),
            array('id' => 6, 'label' => '恋姬无双'),
            array('id' => 7, 'label' => '海猫鸣泣之时'),
            array('id' => 8, 'label' => '女神侧身像格斗'),
        ),
    ),
);
//人物搜索条件
$GLOBALS['person_search_condition'] = array(
    'role_completion' => array(1 => '已完成', 2 => '基本完成', 3 => '未完成'),
    'mugen_version' => array(1 => 'win', 2 => '1.0', 3 => '1.1a', 4 => '1.1b'),
    'person_strongth' => array(1 => '无AI', 2 => '纸', 3 => '并', 4 => '强', 5 => '凶', 6 => '狂', 7 => '神', 8 => '论外'),
    'category' => array(1 => '血条', 2 => '选人界面', 3 => '场景'),
);

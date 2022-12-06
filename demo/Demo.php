<?php
/*
 * @Author: juneChen && junechen_0606@163.com
 * @Date: 2022-11-22 09:57:32
 * @LastEditors: juneChen && junechen_0606@163.com
 * @LastEditTime: 2022-11-22 10:49:05
 * @Description: AC 自动机使用Demo
 * 
 */

namespace Dershun\AcAutomation;

$content = file_get_contents(dirname(__FILE__) . '/content.txt');
$keywords = ['复杂度', '个数', '返回', '代表', '性能', '数据', 'GET', '安全性', '耗时', '优化', '文档', '并发', '类型'];;
$ac = new AcAutomation(new FailTrieTree($keywords));
$res = $ac->search($content);
foreach ($res as $pos) {
    echo mb_substr($content, $pos[0], $pos[1] - $pos[0], 'UTF-8'), PHP_EOL;
}

<?php
/*
 * @Author: juneChen && junechen_0606@163.com
 * @Date: 2022-11-22 09:47:50
 * @LastEditors: juneChen && junechen_0606@163.com
 * @LastEditTime: 2022-11-23 15:18:34
 * @Description: AC 自动机
 * 
 */

namespace Dershun\AcAutomation;

class AcAutomation
{
    /**
     * 根节点
     *
     * @var \stdClass
     */
    private $root;

    public function __construct(FailTrieTree $failTrieTree)
    {
        $this->root = $failTrieTree->getRoot();
    }

    /**
     * 搜索
     * @param $content
     * @return array
     */
    public function search($content)
    {
        $pos_list = [];
        $p = $this->root;

        $matches = unpack('N*', iconv('UTF-8', 'UCS-4', strtolower($content)));
        for ($i = 1; isset($matches[$i]); $i++) {
            $val = $matches[$i];
            while (!isset($p->n[$val]) && $p != $this->root) {
                $p = $p->f;
            }
            $p = isset($p->n[$val]) ? $p->n[$val] : $this->root;
            $temp = $p;
            while ($temp != $this->root) {
                if ($temp->l) {
                    $pos_list[] = [$i - $temp->l, $i];
                }
                $temp = $temp->f;
            }
        }
        return $pos_list;
    }
}

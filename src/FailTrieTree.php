<?php
/*
 * @Author: juneChen && junechen_0606@163.com
 * @Date: 2022-11-22 09:47:50
 * @LastEditors: juneChen && junechen_0606@163.com
 * @LastEditTime: 2022-11-23 15:31:39
 * @Description: 带fail指针的字典树
 * 
 */

namespace Dershun\AcAutomation;

class FailTrieTree extends TrieTree
{

    public function __construct($keywords = [])
    {
        parent::__construct($keywords);
        $this->buildFailIndex();
    }

    /**
     * 构造fail指针
     */
    private function buildFailIndex()
    {
        $queue = [];
        foreach ($this->root->n as $node) {
            $node->f = $this->root;
            $queue[] = $node;
        }
        while ($queue) {
            $node = array_shift($queue);
            foreach ($node->n as $child_node) {
                $val = $child_node->v;
                $p = $node->f;
                while ($p != NULL) {
                    if (isset($p->n[$val])) {
                        $child_node->f = $p->n[$val];
                        break;
                    }
                    $p = $p->f;
                }
                if ($p === NULL) {
                    $child_node->f = $this->root;
                }
                $queue[] = $child_node;
            }
        }
    }
}

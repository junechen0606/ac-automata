<?php
/*
 * @Author: juneChen && junechen_0606@163.com
 * @Date: 2022-11-22 09:47:50
 * @LastEditors: juneChen && junechen_0606@163.com
 * @LastEditTime: 2022-11-23 10:51:01
 * @Description: 字典树
 * 
 */

namespace Dershun\AcAutomation;

class TrieTree
{

    /**
     * 根节点
     *
     * @var \stdClass
     */
    protected $root;

    public function __construct($keywords = [])
    {
        $this->root = $this->createNode();
        foreach ($keywords as $keyword) {
            $this->addKeyword($keyword);
        }
    }

    /**
     * 获取 root 节点
     *
     * @author LuckyJune <junechen_0606@163.com>
     * @return \stdClass
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * 添加关键词
     * @param $keyword
     */
    private function addKeyword($keyword)
    {
        $keyword = trim($keyword);
        if (!$keyword) {
            return false;
        }
        $cur = $this->root;
        $matches = unpack('N*', iconv('UTF-8', 'UCS-4', strtolower($keyword)));
        for ($i = 1; isset($matches[$i]); $i++) {
            $v = $matches[$i];
            if (!isset($cur->n[$v])) {
                $node = $this->createNode($v);
                $cur->n[$v] = $node;
            }
            if (!isset($matches[$i + 1])) {
                $cur->n[$v]->l = $i;
            }
            $cur = $cur->n[$v];
        }
    }

    /**
     * 创建节点
     * @param string $value
     * @return \stdClass
     */
    private function createNode($value = "")
    {
        $node = new \stdClass();
        $node->v = $value;
        $node->n = [];
        $node->f = NULL;
        $node->l = 0;  // keyword长度，0表示非末尾，非0表示keyword的长度
        return $node;
    }
}

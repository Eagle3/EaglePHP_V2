<?php

namespace plugin\tools;
class ArrayTools{

    /**
     * 数组是否包含某个key，包含则返回该key对应的值，反之返回默认值
     * @param array $arr           数组
     * @param string|integer $key  待检查的key
     * @param mixed $default       默认返回值
     * @return mixed
     */
    public static function haveKey(array $arr = [],$key = '',$default = ''){
        return $arr[$key] ?? $default;
    }

    /**
     * 二维数组按照多个字段排序
     * @param array $arr            二维数组,必填
     * @param array $fieldsSort     要排序的字段,必填。示例 ['id' => 'desc','age' => 'desc']
     * @return array
     *
     *  调用示例
     *  $data = [
     *      [
     *          'id' => 100,
     *          'age' => '34',
     *      ],
     *      [
     *          'id' => 100,
     *          'age' => '33',
     *      ],
     *      [
     *          'id' => 102,
     *          'age' => '10',
     *      ]
     *  ];
     *  $res = ArrayTools::sortByMoreFields($data,['id' => 'desc','age' => 'desc']);
     */
    public static function sortByMoreFields(array $arr,array $fieldsSort){
        $fun = 'array_multisort(';
        foreach ($fieldsSort as $field => $sort){
            $sort = strtoupper($sort);
            $sortType = 'SORT_ASC';
            if(in_array($sort,['ASC','DESC'])){
                if($sort == 'DESC'){
                    $sortType = 'SORT_DESC';
                }
            }
            $fun .= 'array_column($arr,"'.$field.'"),'.$sortType.',';
        }
        eval($fun.'$arr);');
        return $arr;
    }

    /**
     * 二维数组按照某个字段的值进行分组
     * @param array $arr            二维数组
     * @param string|int $filed     二维数组中的某个字段
     * @return array
     */
    public static function groupByFiledValue(array $arr,$filed){
        $data = [];
        foreach ($arr as $item){
            $data[$item[$filed]][] = $item;
        }
        return $data;
    }

    /**
     * 过滤掉一维数组中指定的某些元素
     * @param array $arr         一维数组
     * @param array $filterKeys  需要过滤的元素的键 ['id','name']
     * @return array
     */
    public static function filterKeys(array $arr,array $filterKeys){
        foreach ($arr as $key => $value){
            if(in_array($key,$filterKeys)){
                unset($arr[$key]);
            }
        }
        return $arr;
    }

    /**
     * 返回一维数组中指定的某些元素
     * @param array $arr         一维数组
     * @param array $filterKeys  需要返回的元素的键 ['id','name']
     * @return array
     */
    public static function retainKeys(array $arr,array $filterKeys){
        foreach ($arr as $key => $value){
            if(!in_array($key,$filterKeys)){
                unset($arr[$key]);
            }
        }
        return $arr;
    }
}


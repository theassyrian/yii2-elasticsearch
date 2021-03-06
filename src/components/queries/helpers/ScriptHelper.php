<?php
namespace mirocow\elasticsearch\components\queries\helpers;

/**
 * Class ScriptHelper
 * @package mirocow\elasticsearch\components\queries\helpers
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/painless/6.4/painless-examples.html
 */
class ScriptHelper extends QueryHelper
{
    /**
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-sort.html#_script_based_sorting
     *
     * @example doc['column'].values.size()
     * @param string $column
     * @param int $direction
     * @return array
     */
    public static function sort($script = '', int $direction = SORT_ASC, $language = 'painless') :array
    {
        return [
            '_script' => (object) [
                'script' => $script,
                'type' => 'number',
                'order' => $direction === SORT_DESC ? 'desc' : 'asc',
                'lang' => $language,
            ]
        ];
    }

    /**
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-script-query.html
     * @see https://www.elastic.co/guide/en/elasticsearch/painless/5.6/painless-specification.html
     * @see https://www.elastic.co/guide/en/elasticsearch/painless/5.6/painless-examples.html
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/modules-scripting-expression.html
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/modules-scripting-groovy.html
     * @param string $script
     * @param array $params
     * @return array
     */
    public static function query($script = '', $params = [], $language = 'painless') :array
    {
        $body = [
            'script' => (object) [
                'source' => $script,
                'lang' => $language,
            ]
        ];

        if($params){
            $body['script']['params'] = (object) $params;
        }

        return $body;

    }
}
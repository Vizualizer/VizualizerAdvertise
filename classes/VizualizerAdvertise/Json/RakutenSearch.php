<?php
/**
 * Copyright (C) 2012 Vizualizer All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author    Naohisa Minagawa <info@vizualizer.jp>
 * @copyright Copyright (c) 2010, Vizualizer
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Apache License, Version 2.0
 * @since PHP 5.3
 * @version   1.0.0
 */

/**
 * 楽天商品検索のAPIを利用して検索するJSONインターフェイス
 *
 * @package VizualizerAdvertise
 * @author Naohisa Minagawa <info@vizualizer.jp>
*/

class VizualizerAdvertise_Json_RakutenSearch
{

    public function execute()
    {
        $post = Vizualizer::request();

        $result = array();
        if (!empty($post["app_id"]) && !empty($post["keyword"])) {
            $url = "https://app.rakuten.co.jp/services/api/IchibaItem/Search/20140222?applicationId=".$post["app_id"];
            if (!empty($post["aff_id"])) {
                $url .= "&affiliateId=".$post["aff_id"];
            }
            $url .= "&format=json";
            $url .= "&keyword=".urlencode($post["keyword"]);
            $url .= "&sort=".urlencode("-reviewAverage");
            $list = json_decode(file_get_contents($url));
            foreach ($list->Items as $item) {
                $result[] = $item->Item;
            }
        }

        return $result;
    }
}

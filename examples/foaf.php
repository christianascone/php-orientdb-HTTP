<?php

use Doctrine\OrientDB\Binding\HttpBinding;
use Doctrine\OrientDB\Binding\BindingParameters;

require __DIR__.'/../autoload.php';
$param = [];
$param['host'] = '127.0.0.1';
$param['port'] = '2480';
//$param['username'] = 'admin';
//$param['password'] = 'admin';
//$param['database'] = 'GratefulDeadConcerts';
$param['username'] = 'root';
$param['database'] = '***REMOVED***';
$param['password'] = '***REMOVED***';


$parameters = BindingParameters::create($param);
$binding = new HttpBinding($parameters);
$var= '{"name":"Horsefeathers ERIKAZZA Pantaloni da neve blue","sku":"","description":"Horsefeathers ERIKA Pantaloni da neve blue Promo su Zalando IT | Composizione: 100% Poliammide | Promo ordina ora con spedizione gratuita su Zalando IT","picture_path":"i/2016/07/20/07","picture_filename":"0958aee29121869f911c6765f8a8f8d1.jpg","picture_filename_transparent":"0958aee29121869f911c6765f8a8f8d1.png","picture_md5":"0958aee29121869f911c6765f8a8f8d1","created_at":1469000422,"updated_at":1495467370,"out_lh_item_belongs_to_brand":["#21:1"],"in_lh_item_sale_selling":["#33:1"],"out_lh_item_belongs_to_category":["#20:28"],"ean":"","views":18,"user_id":null,"gender":null,"status":null,"@fieldTypes":"in_lh_lookboard_include_item=g,out_lh_item_belongs_to_color=g,created_at=l,updated_at=l,out_lh_item_belongs_to_brand=g,in_lh_item_sale_selling=g,out_lh_item_belongs_to_category=g,views=l"}';
$response = $binding->getDocument('#14:1')->getResult();
$response = $binding->query('Select from #14:1');
$friends = $response->getResultAsRecord();
$rtid = $friends[0]->getRid();
echo $friends;

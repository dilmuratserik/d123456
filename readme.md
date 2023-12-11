<ul>
<li>($_REQUEST['query'] и $_REQUEST['searchid']) уязвимо для SQL-инъекций</li>
<li>В коде нет обработки исключений для операций с базой данных,в ларавел делается легче:</li>
</ul>
<code>
if($request->get('search')['value'] != ''){
$search_value = $request->get('search')['value'];
$reservations->where(function($q) use($search_value){
$q->where('phone', 'like', '%' . $search_value . '%')
->orWhere('payment_id', 'like', '%' . $search_value . '%');
});
} 
</code>
<ul>
<li>Search нарушает принцип единственной ответственности</li>
<li>Отсутствие валидации данных</li>
</ul>
Запуск:
<ul>
<li>composer install</li>
<li>src/Database.php connection to database </li>
<li>php database/migrate.php</li>
<li>php database/faker.php</li>
<li>php -S localhost:8000</li>
</ul>


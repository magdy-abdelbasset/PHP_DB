# PHP_DB
 التعامل مع قواعد البيانات بسهولة
 لقد قمت ببناء جمل مستوحاه من أطار عمل لارفيل

### description  
هى مكتبة خفيفة الوزن للتعامل مع قاعد البيانات
ققرر وضعها كمكتبة مفتوحة المصدر
 حاليا هى تدعم My Sql
 PDO
 وتم اختبارها وتجربتها
 أذا كنت تود المشاركة فأنا ارحب بذلك
### used
    <?php $db = new Src\DB();
    $db->table('tags')->insert([
        // "id"=>"2",
        "name"=>"test",
        "name_ar"=>"test_ar"]));
    ?>
    $db->table('table')->all();
    to change select
    $db->setColumns($columns)
    $db->table('table')->first();
    $db->table('table')->where('column',$value)->get();
    $db->table('table')->where('column',$value)->orWhere('column',$value)->get();
    $db->table('table')->find($value);


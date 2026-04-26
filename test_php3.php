<?php
abstract class ParentClass {
    public function update(\stdClass $model, array $attributes = []): mixed {
        return null;
    }
}
class ChildClass extends ParentClass {
    public function update(array $data, $id = []): mixed {
        return null;
    }
}
$c = new ChildClass();
echo "Runs fine";

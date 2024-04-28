use PHPUnit\Framework\TestCase;

class BracketDeleterTest extends TestCase {

    public function testProcessRemovesTextInsideBrackets() {
        // Подготовка
        $input = "Привет <мир>";
        $expected = "Привет ";
        $deleter = new BracketDeleter($input);

        // Действие
        $deleter->process();
        $result = $deleter->getResult();

        // Проверка
        $this->assertEquals($expected, $result);
    }

    public function testProcessRemovesTextInsideDifferentTypesOfBrackets() {
    // Подготовка
    $input = "Привет {мир}! [Как] дела? (Хорошо) <До свидания>";
    $expected = "Привет !  дела?  ";
    $deleter = new BracketDeleter($input);

    // Действие
    $deleter->process();
    $result = $deleter->getResult();

    // Проверка
    $this->assertEquals($expected, $result);
}

public function testProcessHandlesNestedBrackets() {
    // Подготовка
    $input = "Привет [мир, (как [дела])]!";
    $expected = "Привет !";
    $deleter = new BracketDeleter($input);

    // Действие
    $deleter->process();
    $result = $deleter->getResult();

    // Проверка
    $this->assertEquals($expected, $result);
}

public function testProcessHandlesNoBrackets() {
    // Подготовка
    $input = "Текст без скобок";
    $expected = "Текст без скобок";
    $deleter = new BracketDeleter($input);

    // Действие
    $deleter->process();
    $result = $deleter->getResult();

    // Проверка
    $this->assertEquals($expected, $result);
}
}
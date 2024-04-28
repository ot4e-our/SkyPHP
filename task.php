class BracketDeleter { 
 
 private string $destination = ''; 

 private array $brackets = [ 
     '(' => ')', 
     '<' => '>', 
     '{' => '}', 
     '[' => ']', 
 ]; 

 public function __construct(private string $source) {} 

 public function process() {
     $stack = [];
     $insideBracket = false;

     foreach (str_split($this->source) as $char) {
         if (array_key_exists($char, $this->brackets)) {
             $stack[] = $char;
             $insideBracket = true;
         } elseif (in_array($char, $this->brackets)) {
             if ($insideBracket && $this->brackets[array_pop($stack)] === $char) {
                 $insideBracket = false;
             }
         } elseif (!$insideBracket) {
             $this->destination .= $char;
         }
     }
 }

 public function getResult(): string { 
     return $this->destination; 
 } 
}
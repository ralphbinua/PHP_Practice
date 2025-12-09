<?php
    class StringUtility{
        public $word;

        public function __construct($word) {
            $this->word = $word;
        }

        public function getWord() {
            return $this->word;
        }

        public function setWord($word) {
            $this->word = $word;
        }

        public function shout($word) {
            $shout = strtoupper($word);
            echo $shout;
        } 
        public function whisper($word) {
            $shout = strtolower($word);
            echo $shout;
        }

          public function whirepeatsper($word, $repeat) {
            $shout = str_repeat($word,2);
            echo $shout;
        }
    }

    $word1 = new StringUtility("Hello World");
    $word1->shout("hello world\n");
    $word1->whisper("hello world\n");
    $word1->whirepeatsper("hello world ",2);
?>
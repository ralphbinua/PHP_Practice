<?php

    class BankTransaction{
        public $bank_name;
        public $transaction;
        private $account_no;
        private $amount;
        private $savings_amount= 10000;

        public function __construct($bank_name, $transaction, $account_no, $amount){
            $this->bank_name = $bank_name;
            $this->transaction = $transaction;
            $this->account_no = $account_no;
            $this->amount = $amount;
        }

        public function getBank_name(){
            return $this->bank_name;
        }

        public function getTransaction(){
            return $this->transaction;
        }

        public function getAccountNo(){
            return $this->account_no;
        }

        public function getAmount(){
            return $this->amount;
        }

        public function setBank_name($bank_name){
        $this->bank_name = $bank_name;
        }

        public function setTransaction($transaction){
            $this->transaction = $transaction;
        }

        public function setAccount_no( $account_no){
            $this->account_no = $account_no;
        }

        public function setAmount($amount){
            $this->amount = $amount;
        }

        public function getInfo(){
            echo "Bank Name: ". $this->bank_name ."\n";
            echo "Customer Account No: ". $this->account_no ."\n";
            echo "Type of Transaction: ". $this->transaction ."\n";
            echo "Current Balance: ". $this->savings_amount ."\n";
            echo "Amount: ". $this->amount ."\n";
            }

        public function newBalance(){

            if($this->transaction == "D"){
                echo "New Balance: ". $this->savings_amount + $this->amount."\n\n";
            }else if($this->transaction == "W"){
                echo "New Balance: ". $this->savings_amount - $this->amount ."\n\n";
            }else{
                echo "Unable to process this transaction! Invalid Transaction type!\n\n";
            }
            
        }
    }

    $customer1 = new BankTransaction("BDO","W", "ACNO0000001",3000);
    $customer1->getInfo();
    $customer1->newBalance();
    

    $customer2 = new BankTransaction("BPI","D", "ACNO0000002",3000);
    $customer2->getInfo();
    $customer2->newBalance();

    $customer3 = new BankTransaction("METROBANK","AB", "ACNO0000003",3000);
    $customer3->getInfo();
    $customer3->newBalance();
?>
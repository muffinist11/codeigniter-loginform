<?php
defined('BASEPATH') or exit('No direct script access allowed');

class form extends CI_Controller{

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Form_model');
        date_default_timezone_set('Asia/Tokyo');
        
    }

    public function index()
    {   
        //初期画面

        $data = null;
        

        if (!empty($_SESSION['error'])){     
            $data['error'] = $_SESSION['error']; 
            unset($_SESSION['error']);
            // $page_flag = 0;

        } elseif (!empty($_SESSION['clean'])){
          $data['clean'] = $_SESSION['clean'];
          unset($_SESSION['clean']);
          // $page_flag = 1;
        }

        $this->load->view('index',$data);
    }

        //入力エラー表示 validation
        public function validation() {


            $name = @$this->input->post('name',true) ?:null;
            $kana = @$this->input->post('kana',true) ?:null;
            $tel = @$this->input->post('tel',true) ?:null;
            $mail = @$this->input->post('mail',true) ?:null;
            $pass = @$this->input->post('pass',true) ?:null;
            $year = @$this->input->post('year',true) ?:null;
            $sex = @$this->input->post('sex',true) ?:null;
            $magagine = @$this->input->post('magagine',true) ?:null;
            
            $error = null;
            $clean = null;
            
          
            if(empty($name)) {
              $error[] = "「氏名」は必ず入力してください";
            } elseif( 20 < mb_strlen($name)) {
              $error[] = "「氏名は20文字以内で入力してください」";
            } 
      
      
            if(empty($kana)) {
              $error[] = "「カナ」は必ず入力してください";
            } elseif( 20 < mb_strlen($kana)) {
              $error[] = "「カナ」は20文字以内で入力してください」";
            } 
      
            if(is_numeric($tel) !== true) {
              $error[] = "「電話番号」は半角数字で入力してください";
            }  
      
            if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$mail )) {
              $error[] = "「メール」は正しい形式で入力してください";
            }  
            
            if(empty($pass)) {
              $error[] = "「パスワード」は必ず入力してください";
            } elseif(6 > mb_strlen($pass)) {
              $error[] = "「パスワード」は６桁以上で入力してください";
            }

            if(empty($error)){
              $clean = array();
              foreach( $_POST as $key => $value ) {
              $clean[$key] = $this->security->xss_clean($value);
              $_SESSION['clean'] = $clean;
          }
              
            } else {
              $_SESSION['error'] = $error;
            }
            header('location: /CodeIgniterform/form/index');
            exit();

          }

          public function db_act(){


            if(!empty($_POST['btn_submit'])){

  
              $name = @$this->input->post('name',true);
              $tel = @$this->input->post('tel',true);
              $mail = @$this->input->post('mail',true);
              $pass = @$this->input->post('pass',true);
              $year = @$this->input->post('year',true);
              $sex = @$this->input->post('sex',true);
              $magagine = @$this->input->post('magagine',true);

              $hash_pass = password_hash($pass,PASSWORD_DEFAULT);

              $data = [
                'name' => $name,
                'tel' => $tel,
                'mail' => $mail,
                'pass' => $hash_pass,
                'year' => $year,
                'sex' => $sex,
                'magagine' => $magagine
              ];

              $this->Form_model->insert_row($data);

            $this->load->view('touroku');
          }
        }
        

        public function login(){
          $this->load->view('login');
        }

        public function pass_check(){

          header("Content-Type: application/json; charset=utf-8");

          if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            if (empty($this->input->post('mail', true))) {
              header('HTTP/1.1 401 Unauthorized');
              echo json_encode(['message' => 'アドレスが間違っています']);
              exit();
            }

            if (empty($this->input->post('pass', true))) {
              header('HTTP/1.1 401 Unauthorized');
              echo json_encode(['message' => 'パスワードが間違っています']);
              exit();
            }

            $mail = $this->input->post('mail',true);
            $pass = $this->input->post('pass',true);
            
            
            $this->Form_model->log_get($mail);
            $this->load->model('Form_model');

            $user = $this->Form_model->log_get($mail);


            if(!password_verify($pass,$user['pass'])){
              header('HTTP/1.1 401 Unauthorized');
              echo json_encode(['message' => 'パスワードが間違っています']);
              exit();
            } else {
            header("Location: /CodeIgniterform/form/edit");
            }
          
          } else {
            header('HTTP/1.1 405 Method Not Allowed');
            echo json_encode(['message' => '許可されていないメソッドです']);             
          }
          exit();
        }
        

        public function edit(){

        $this->Form_model->table_row();

        $data['result'] = $this->Form_model->table_row();
        $this->load->view('common/header');
        $this->load->view('edit',$data);
        }

        public function edy(){
          
          $id = $this->input->post('id');
          $name = $this->input->post('name');
          $tel = $this->input->post('tel');
          $mail = $this->input->post('mail');
          $year = $this->input->post('year');
          $error_message = null;

          if(!empty($this->input->post('btn_submit'))){
            $this->load->view('common/header');
            $this->load->view('edy');
          }

            if (!empty($this->input->post('change'))){

              $id = @$this->input->post('id');
              $name = @$this->input->post('name');
              $tel = @$this->input->post('tel');
              $mail = @$this->input->post('mail');
              $year = @$this->input->post('year');

              $data = [
                'name' => $name,
                'tel' => $tel,
                'mail' => $mail,
                'year' => $year
              ];

              $this->Form_model->update_row($id,$data);

              header('location: /CodeIgniterform/form/edit');
            
            }

        
      }

        public function delete(){

          if (!empty($id = $this->input->get('message_id', true))) {
            $id = $this->input->get('message_id', true);
            if ($this->Form_model->delete_row($id)) {
                header('location: /CodeIgniterform/form/edit');
                exit();
            }
        }
      }

        public function download(){
          header("Content-Type: application/octet-stream");
          header("Content-Disposition: attachment; filename=会員情報.csv");
          header("Content-Transfer-Encoding: binary");

          $this->Form_model->csv();
          $csv_data = null;

          $message_array = $this->Form_model->csv();
          $csv_data .= '"ID","名前","電話番号","メールアドレス","生年月日","性別"'."\n";
          foreach( $message_array as $value ) {

            // データを1行ずつCSVファイルに書き込む
          $csv_data .= '"' . $value['id'] . '","' . $value['name'] . '","' . $value['tel'] . '","' . $value['mail'] . '","' .$value['year']  . '","' .$value['sex'] . "\"\n";
        }
        echo $csv_data;


        }




    

    
}
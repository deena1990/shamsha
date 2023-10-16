<?php
class Case_report_model extends CI_Model{

    function __construct() {
        // Set orderable column fields
        $this->column_order = array( null, 'fullname','case_id','mobile', 'volunteer', 'client_country', 'is_it_safe_to_cal_back','client_follow_up','form_name', 'created_at', 'id');
        // Set searchable column fields
        $this->column_search = array('fullname','case_id','mobile', 'client_country', 'volunteer','is_it_safe_to_cal_back','client_follow_up','form_name', 'created_at', 'id');
        // Set default order
        $this->order = array('id' => 'desc');
    }

    public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function countAll(){
        $this->db->from('wc_cr_report');
        return $this->db->count_all_results();
    }

    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){

        $this->db->from('wc_cr_report');
        $i = 0;
        // loop searchable columns
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }

                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    public function get_row($id){
        $this->db->where('id', $id);
        return $this->db->get('wc_cr_report')->row();
    }
    
    public function get_case_row($id){
        $this->db->select('wc_cr_report.*,victim.status')
            ->from('wc_cr_report')
            ->join('victim', 'wc_cr_report.case_id = victim.case_id')
            ->where('wc_cr_report.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function update($data){
        $this->db->where('case_id', $data['case_id']);
        $this->db->set($data);
        return $this->db->update('victim');
    }
    
    public function update_caseworkAtSight($form_name,$id){
        $this->db->where('id', $id);
        $this->db->set($form_name);
        return $this->db->update('wc_cr_report');
    }

    public function update_casework_AtSight($form_name,$id){
        $this->db->where('id', $id);
        return $this->db->update('wc_cr_report',array('form_name'=>$form_name));
    }

    public function add_caserform($data,$victim){
        $this->db->insert('wc_cr_report',$data);
        $this->db->insert('victim',$victim);
    }

    public function get_country_code(){
        return $this->db->get('country')->result();
    }

    public function update_case_report_row($id,$data){
       
        $this->db->where('id', $id);
        return $this->db->update('wc_cr_report',$data);
    }

    public function get_case_details($case_id,$volunteer_id){
       
        $this->db->where('case_id', $case_id);
        $this->db->where('volunteer', $volunteer_id);
        return $this->db->get('wc_cr_report')->row();
    }

    public function get_intake_form_details($case_id){
       
        $this->db->where('case_id', $case_id);
        $case = $this->db->get('victim')->row();
        $this->db->where('case_id', $case_id);
        $chat = $this->db->get('chat_form')->row();
        $data = array_merge((array)$case,(array)$chat);
        return $data;
    }

    
}
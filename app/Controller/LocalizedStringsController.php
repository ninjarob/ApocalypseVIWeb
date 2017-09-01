<?php
App::import('Controller', 'AdminBase');
class LocalizedStringsController extends AdminBaseController {
	var $name = 'LocalizedStrings';
    var $uses = array("StringKey", "LocalizedString");
    
    function admin_index() {
        $this->set("stringKeys", $this->StringKey->find("all", array("order"=>"string_key")));
    }
    
    function admin_edit($id=null) {
        if(!empty($this->data)) {
            if ($id != null) {
                $this->StringKey->delete($id, true);
            }
            if($this->StringKey->save($this->request->data)) {
                $tempId = $this->StringKey->id;
                $ls = array(
                    'string_key_id'=>$tempId,
                    'lang_id' => 1,
                    'text' => $this->request->data['LocalizedString']['text']
                );
                $this->LocalizedString->save($ls);
                $this->Session->setFlash("String Saved!");
                if ($id == null) $id = $tempId;
                $this->redirect('/admin/localized_strings/edit/'.$id);
            }
        }
        if ($id != null && $id != "null")
        {
            $this->request->data = $this->StringKey->findById($id);
        }
    }
    
    function admin_delete($id) {
        $this->StringKey->delete($id, true);
        $this->redirect('/admin/localized_strings/index');
    }
}

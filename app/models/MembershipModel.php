<?php

class MembershipModel {
  use Database;

    
    public function getMemberships() {
        $query = "SELECT * FROM membership_types";
        return $this->query($query);
    }

    
}

<?php


namespace App\Repositories\Interfaces;


interface IPolicyPaymentRepository extends IRepository
{
    public function getPolicyPayments($policy_id);
}

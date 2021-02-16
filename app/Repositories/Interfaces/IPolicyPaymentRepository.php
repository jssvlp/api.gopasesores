<?php


namespace App\Repositories\Interfaces;


interface IPolicyPaymentRepository extends IRepository
{
    public function getPolicyPayments($policy_id);
    public function getUpcomingPaymentsToBeDue();
    public function getPaymentsPendingToCollectFromClient();
    public function getPaymentsPendingToPayToInsurances();
}

<?php
  function getStatus($status) {
    if ($status == 0) {
      return 'Cancel';
    } else if ($status == 1) {
      return 'Pending';
    } else if ($status == 2) {
      return 'Success';
    }
  }

?>

<div class="data-tables">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card card_border p-4">
            <h3 class="card__title"><?=$header?></h3>
            <div class="table-responsive">
              <div id="example_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="example_length"><label></label></div><table id="example" class="display dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
                <thead>
                  <tr role="row"><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Emp. Name: activate to sort column ascending" style="width: 291px;">Transaction</th><th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Designation: activate to sort column descending" style="width: 443px;" aria-sort="ascending">Amount</th><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Joining date: activate to sort column ascending" style="width: 216px;">Date Created</th><th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Emp. Status: activate to sort column ascending" style="width: 234px;">Balance</th></tr>
                </thead>
                <tbody>
                <?php foreach($transactions as $transaction): ?>
                    
                    <tr role="row" class="odd">
                        <td class=""><?=($transaction['transaction_type'] == 0 ? 'Debit (withdrawal)' : ( $transaction['transaction_type'] == 1 ?'Credit (investment)' : 'Credit (referral bonus)'))?></td>
                        <td class="sorting_1"><?=$transaction['amount']?></td>
                        <td><?=(explode(" ", $transaction['date_created'])[0])?></td>
                        <td><span class="badge badge-success"><?=$transaction['balance']?></span></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php if (sizeof($transactions) == 0): ?>
                    <div style="text-align: center;font-size: 20px;"><b>No Transaction yet</b></div>
            <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
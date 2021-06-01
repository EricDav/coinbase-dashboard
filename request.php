<script>
  function formatDate(dateStr) {
    const formatedDate = dateStr + ' UTC';
    return (new Date(formatDate)).toString();
  }
</script>
<div class="data-tables">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card card_border p-4">
            <h3 class="card__title">Withdrawal Request</h3>
            <div class="table-responsive">
              <div id="example_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="example_length"><label></label></div><table id="example" class="display dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
                <thead>
                  <tr role="row">
                      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Emp. Name: activate to sort column ascending" style="width: 291px;">Name</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Designation: activate to sort column descending" style="width: 443px;" aria-sort="ascending">Wallet</th>
                      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Joining date: activate to sort column ascending" style="width: 216px;">Amount</th>
                      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Emp. Status: activate to sort column ascending" style="width: 234px;">Date Created</th>
                      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Emp. Status: activate to sort column ascending" style="width: 234px;">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($requests as $request): ?>
                    <tr role="row" class="odd">
                        <td class=""><a><?=$request['name']?></a></td>
                        <td class="sorting_1"><?=$request['wallet']?></td>
                        <td><?=$request['amount']?></td>
                        <td><?=$request['date_created']?></td>
                        <td><a href="/requests?w=<?=$request['id']?>&t_id=<?=$request['transaction_id']?>"><button type="button" class="btn btn-primary">Confirm</button></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php if (sizeof($requests) == 0): ?>
                    <div style="text-align: center;font-size: 20px;"><b>No withdrawal request</b></div>
            <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
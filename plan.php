<div class="data-tables">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card card_border p-4">
            <h3 class="card__title"><?=$header?></h3>
            <div class="table-responsive">
              <div id="example_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="example_length"><label></label></div><table id="example" class="display dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
                <thead>
                  <tr role="row">
                      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Emp. Name: activate to sort column ascending" style="width: 291px;">Plan</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Designation: activate to sort column descending" style="width: 443px;" aria-sort="ascending">Percent</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Designation: activate to sort column descending" style="width: 443px;" aria-sort="ascending">Referral %</th>
                      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Joining date: activate to sort column ascending" style="width: 216px;">Price Range</th>
                      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Emp. Status: activate to sort column ascending" style="width: 234px;">Time Frame</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($plans as $plan): ?>
                    <tr role="row" class="odd">
                        <td class=""><a href="/withdraw"><?=$plan['name']?></a></td>
                        <td class="sorting_1"><?=$plan['percent']?> %</td>
                        <td class="sorting_1"><?=$plan['referral_percent']?> %</td>
                        <td>$ <?=$plan['price_rang']?></td>
                        <td><span class="badge badge-success"><?=$plan['time_frame']?> days</span></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php if (sizeof($plans) == 0): ?>
                    <div style="text-align: center;font-size: 20px;"><b>You did not have any investment</b></div>
            <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
<div class="modal fade" id="searchModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Search Donors</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <div class="modal-body mx-4">

        <div class="mb-4" style="overflow-y: auto;">
          <table class="table">
            <thead>
              <tr>
                <th style="white-space: nowrap;" class="text-start">Name</th>
                <th style="white-space: nowrap;" class="text-start">Barangay</th>
                <th style="white-space: nowrap;" class="text-center">Blood Type</th>
                <th style="white-space: nowrap;" class="text-center">Action</th>
              </tr>
              <tr>
                <th class="text-start">
                  <input type="text" class="form-control" placeholder="Last Name" id="d_lname" >
                </th>
                <th class="text-center">
                  <select name="" id="d_barangay_id" class="form-control">
                    <option value="">- Select Barangay</option>
                  </select>
                </th>
                <th class="text-center">
                  <select name="" id="d_blood_type_id" class="form-control">
                    <option value="">- Select Blood Type</option>
                  </select>
                </th>
                <th class="text-center">
                  <button class="btn btn-primary btn-raised btn-sm" onclick="get_search()" >SEARCH</button>
                </th>
              </tr>
            </thead>
            <tbody id="tbl_body">
              <tr>
                <td class="text-start">Name</td>
                <td class="text-start">Barangay 1</td>
                <td class="text-center">A+</td>
                <td class="text-center">
                  <button class="btn btn-raised btn-primary btn-sm">Request</button>
                </td>
              </tr>
              <tr>
                <td class="text-start">Name</td>
                <td class="text-start">Barangay 1</td>
                <td class="text-center">A-</td>
                <td class="text-center">
                  <div class=""><span class="bg-success text-white" style="padding: 3px 8px;">Requested</span></div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
                    
      </div>
      
    </div>
  </div> 
</div>


<div class="modal fade" id="chat_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Search Donors</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <div class="modal-body mx-4">

        <div class="mb-4" style="overflow-y: auto;">
          <table class="table">
            <thead>
              <tr>
                <th style="white-space: nowrap;" class="text-start">Name</th>
                <th style="white-space: nowrap;" class="text-start">Barangay</th>
                <th style="white-space: nowrap;" class="text-center">Blood Type</th>
                <th style="white-space: nowrap;" class="text-center">Action</th>
              </tr>
              <tr>
                <th class="text-start">
                  <input type="text" class="form-control" placeholder="Last Name" id="d_lname" >
                </th>
                <th class="text-center">
                  <select name="" id="d_barangay_id" class="form-control">
                    <option value="">- Select Barangay</option>
                  </select>
                </th>
                <th class="text-center">
                  <select name="" id="d_blood_type_id" class="form-control">
                    <option value="">- Select Blood Type</option>
                  </select>
                </th>
                <th class="text-center">
                  <button class="btn btn-primary btn-raised btn-sm" onclick="get_search()" >SEARCH</button>
                </th>
              </tr>
            </thead>
            <tbody id="tbl_body">
             
            </tbody>
          </table>
        </div>
                    
      </div>
      
    </div>
  </div> 
</div>
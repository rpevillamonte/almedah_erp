<div class="container mt-3 rounded">
  <div class="row d-flex justify-content-center">
      <nav class="navbar navbar-expand-lg navbar-light bg-light p-4" style="justify-content: space-between; width: 100%;">
        <h4 class="font-weight-bold text-black"> <a id="backButton" href="#" class="fas fa-arrow-left back-button"><span></span></a> New BOM <span>(number)</span> </h4>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ml-auto">
            <!--
              <li class="nav-item dropdown li-bom">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                More
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">Edit</a></li>
                <li><a class="dropdown-item" href="#">Delete</a></li>
                <li><a class="dropdown-item" href="javascript:onclick=loadBOM();">Go Back</a></li>
              </ul>
            </li>
            -->
            <button class="btn btn-primary" type="submit" onclick="addBOM();">Save<img src="images/savebutton1.png"></button>
          </ul>
        </div>
      </nav>
      <div class="col-sm p-4 bg-light">
        <div id="alert-message">
        </div>
        <form method="POST">
          <div class="row row-space">
            <div class="col-6">
              <div>
                <div>
                  <label class="label">Item</label>
                </div>
                <div class="input-group">
                  <input class="form-control" type="text" id="item_code" name="item" oninput="searchProduct($('#item_code').val())" required>
                </div>
              </div>
              <br>
              <div>
                <div>
                  <label class="label">Quantity</label>
                </div>
                <div class="input-group">
                  <input class="form-control" type="text" id="quantity" name="quantity" required>
                </div>
              </div>
            </div>
            <div class="col-6">
              <table>
                <tr>
                  <td><input type="checkbox" id="active" name="active" value="active"></td>
                  <td>
                    <label for="active">Is Active</label>
                  </td>
                </tr>
                <tr>
                  <td><input type="checkbox" id="default" name="default" value="default"></td>
                  <td>
                    <label for="default">Default</label>
                  </td>
                </tr>
                <tr>
                  <td><input type="checkbox" id="alt_item" name="alt_item" value="alt_item"></td>
                  <td>
                    <label for="alt_item">Allow Alternative Item</label>
                  </td>
                </tr>
                <tr>
                  <td><input type="checkbox" id="sub_item" name="sub_item" value="sub_item"></td>
                  <td>
                    <label for="sub_item">Set rate of sub-assembly item based on BOM</label>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-6" id="to-appear" style="display: none;">
              <div>
                <div><label class="label">Item Name</label></div>
                <div class="input-group">
                  <input class="form-control" type="text" name="item_name" id="item_name" readonly>
                </div>
              </div>
              <div>
                <div><label class="label">Item UOM</label></div>
                <div class="input-group">
                  <input class="form-control" type="text" name="item_uom" id="item_uom" readonly>
                </div>
              </div>
            </div>
            <script type="text/javascript">
              function searchProduct(product_code) {
                $.ajax({
                  method: "GET",
                  url: '/search-product/' + product_code,
                  data: {'product_code' : product_code},
                  success: function(data) {
                    $("#to-appear").css('display', 'block');
                    $("#item_name").val(data.product_name);
                    $("#item_uom").val(data.product_unit);
                  }
                });
              }
            </script>
          </div>
          <hr>
          <div class="row row-space">
            <div class="col-6">
              <div><label class="label">Project</label></div>
              <div class="input-group">
                <input class="form-control" type="text" name="project">
              </div>
            </div>
            <div class="col-6">
              <div><label class="label">Rate of Materials based on</label></div>
              <div class="input-group">
                <select class="form-control" type="text" name="project">
                  <option>Valuation Rate</option>
                  <option>Last Purchase Rate</option>
                  <option>Price List</option>
                </select>
              </div>
            </div>
            <br><br>
            <div class="col-6">
              <div><label class="label">Currency</label></div>
              <div class="input-group">
                <input class="form-control" type="text" id="currency" name="currency">
              </div>
            </div>
          </div>
          <hr>
          <h4 class="font-weight-bold text-black">OPERATIONS</h4>
          <div class="col-3">
            <table>
              <tr>
                <td><input type="checkbox" name="check2" id="operations2" onclick="operations();"></td>
                <td>
                  <label for="operations2">With Operations</label>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-6" id="operations" style="display:none">
            <div><label class="label">Transfer Material Against</label></div>
            <div class="input-group">
              <select class="form-control" type="text" name="project">
                <option></option>
                <option>Work Order</option>
                <option>Job Card</option>
              </select>
            </div>
            <div><label class="label">Routing</label></div>
            <div class="input-group">
              <input class="form-control" type="text" name="Unit">
            </div>
          </div>
          <hr>
          <h4 class="font-weight-bold text-black">MATERIALS</h4>
          <div class="col-4">
            <table>
              <tr>
                <td><input type="checkbox" name="check2" id="qualInspect" onclick="qual();" /></td>
                <td>
                  <label for="qualInspect">Quality Inspection Required</label>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-6" id="qual2" style="display:none">
            <div><label class="label">Quality Inspection Template</label></div>
            <div class="input-group">
              <input class="form-control" type="text" name="Unit">
            </div>
          </div>
          <br>
          <label class="label">Items</label>
          <style>
            /* Component's Table */
            table {
              border-collapse: collapse;
              width: 100%;
            }
            #itemtable,
            #itemtr {
              border: 1px solid black;
            }
            th,
            td {
              text-align: left;
              padding: 8px;
            }
          </style>
          <table id="itemtable">
            <tr id="itemtr">
              <th><input type="checkbox" name="check2" /></th>
              <th>Item Code</th>
              <th>Quantity</th>
              <th>UOM</th>
              <th>Rate</th>
              <th>Amount</th>
              <th></th>
            </tr>
            <tr id="itemtr">
              <td><input type="checkbox" name="check2" /></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><select type="text" name="project">
                  <option></option>
                  <option></option>
                  <option></option>
                </select></td>
            </tr>
          </table>
          <br>
          <button>Add Multiple</button>
          <button>Add Row</button>
          <hr>
          <h5 class="font-weight-bold text-black">SCRAP   <span id="scrapDropDown" href="#" class="fas fa-angle-down"></span></h5>
          <div id="scrapDrop" style="display: none;">
            <label class="label">Scrap Items</label>
            <table id="itemtable">
              <tr id="itemtr">
                <th><input type="checkbox" name="check2" /></th>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th></th>
              </tr>
              <tr id="itemtr">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </table>
            <br>
            <button>Add Row</button>
          </div>
          <hr>
          <h5 class="font-weight-bold text-black">WEBSITES   <span id="webDropDown" href="#" class="fas fa-angle-down"></span></h5>
          <div id="webDrop" style="display: none;">
            <div class="col-3">
              <table>
                <tr>
                  <td><input type="checkbox" name="check2" id="website" onclick="showWeb();"></td>
                  <td>
                    <label for="website">Show in Website</label>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-6">
              <div class="input-group" id="attach" style="display:none">
                <label class="label">Image</label>
                <input class="input--style-4" type="file">
              </div>
            </div>
            <br>
            <label>Route</label><br>
            <textarea class="form-control" id="route" cols="25" rows="7" style="resize: none;"></textarea>
          </div>
        </form>
      </div>
  </div>
</div>

<!-- Main JS-->

<style>
  /* Component's Table */
  table {
    border-collapse: collapse;
    width: 100%;
  }
  th,
  td {
    text-align: left;
    padding: 8px;
  }
  #backButton,
  #scrapDropDown,
  #webDropDown {
    color: black;
    text-decoration: none;
  }
</style>

<script type="text/javascript">
  $('#backButton').on('click', function(event) {
    $('#contentBOM').load('/bom');
  });

  $('#webDropDown').on('click', function(event) {
    var result = $('#webDrop')[0];
    if($('#webDropDown').hasClass("fas fa-angle-down")) {
      result.style.display = "block";
      $('#webDropDown').attr('class', 'fas fa-angle-up');
    } else {
      result.style.display = "none";
      $('#webDropDown').attr('class', 'fas fa-angle-down');
    }
  });

  $('#scrapDropDown').on('click', function(event) {
    var result = $('#scrapDrop')[0];
    if($('#scrapDropDown').hasClass("fas fa-angle-down")) {
      result.style.display = "block";
      $('#scrapDropDown').attr('class', 'fas fa-angle-up');
    } else {
      result.style.display = "none";
      $('#scrapDropDown').attr('class', 'fas fa-angle-down');
    }
  });
</script>

<script type="text/javascript">
  function addBOM() {
    $(document).ready(function() {
      var form = new FormData();
      form.append('product_code', $("#item_code").val());
      form.append('quantity', $("#quantity").val());
      form.append("item_uom", $("#item_uom").val());
      form.append("currency", $("#currency").val());
      var active_value = $("#active").prop("checked") == true ? 1 : 0;
      form.append('is_active', active_value);
      var default_value = $("#default").prop("checked") == true ? 1 : 0;
      form.append('is_default', default_value);
      var alt_value = $("#alt_item").prop("checked") == true ? 1 : 0;
      form.append('alt_item', alt_value);
      var sub_value = $("#sub_item").prop("checked") == true ? 1 : 0;
      form.append('sub_item', sub_value);
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: '/createBOM',
        type: "POST",
        data: form,
        contentType: false,
        processData: false,
        success: function(data) {
          alert(data);
          $('#contentBOM').load('/bom');
        },

      });
    });
  }
  function qual() {
    // Get the checkbox
    var checkBox = document.getElementById("qualInspect");
    // Get the output text
    var text = document.getElementById("qual2");
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
      text.style.display = "block";
    } else {
      text.style.display = "none";
    }
  }
  function operations() {
    // Get the checkbox
    var checkBox = document.getElementById("operations2");
    // Get the output text
    var text = document.getElementById("operations");
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
      text.style.display = "block";
    } else {
      text.style.display = "none";
    }
  }
  function showWeb() {
    // Get the checkbox
    var checkBox = document.getElementById("website");
    // Get the output text
    var text = document.getElementById("attach");
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
      text.style.display = "block";
    } else {
      text.style.display = "none";
    }
  }
</script>

<!-- end document-->
<?php
$xml = new SimpleXMLElement('https://api.data.gov.in/resource/9ef84268-d588-465a-a308-a864a43d0070?api-key=579b464db66ec23bdd000001cdd3946e44ce4aad7209ff7b23ac571b&format=xml&offset=0&limit=10', 0, TRUE);

?>
<html>
<div id="online-status" align="center" style = "color:#E4308F;font-size: 150%; background-color:powderblue;height: 35px">Internet status - online</div>

<br><br>
<div align="center">
<strong  style="font-size: 150%; ">Latest Grocery Price </strong>
</div>
<br>
<form align="center" style="color:#E4308F;">
  Search by District: <input class="m-2" type="text" name="searchd" id="myInputd">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  Search by Market: <input class="m-2" type="text" name="searchv" id="myInputv">
  </form>
<br>
<table align="center" border="1px" >
  <thead style="background-color: powderblue;">
    <tr style="color: #E4308F;">
      <th>Timestamp</th>
      <th>State</th>
      <th>District</th>
      <th>Market</th>
      <th>Commodity</th>
      <th>Variety</th>
      <th>Arrival_date</th>
      <th>Min_price</th>
      <th>Max_price</th>
      <th>Modal_price</th>
    </tr>
  </thead>
  <tbody id="tbody-id">

<?php foreach ($xml->records->item as $Element) :?>
    <tr align ="center"class="row">
      <td class="timestamp"><?php echo $Element->timestamp; ?></td>
      <td class="state"><?php echo $Element->state; ?></td>
      <td class="district"><?php echo $Element->district; ?></td>
      <td class="market"><?php echo $Element->market; ?></td>
      <td class="commodity"><?php echo $Element->commodity; ?></td>
      <td class="variety"><?php echo $Element->variety; ?></td>
      <td class="arrival_date"><?php echo $Element->arrival_date; ?></td>
      <td class="min_price"><?php echo $Element->min_price; ?></td>
      <td class="max_price"><?php echo $Element->max_price; ?></td>
      <td class="modal_price"><?php echo $Element->modal_price; ?></td>
    </tr>
<?php endforeach; ?>
</tbody>
<?php echo"
<script>
  const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent; 
  const comparer = (idx, asc) => (a, b) => ((v1, v2) => v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2) )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

   document.querySelectorAll('th').forEach(th => 
     th.addEventListener('click', (() => { 
       const table = th.closest('table'); 
       Array.from(table.querySelectorAll('tr.row')).sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc)).forEach(tr => table.appendChild(tr)); 
       })
      )
    );
 </script>" 
  ?>
  <?php echo"
  <script>
    window.addEventListener('online', updateStatus);
    window.addEventListener('offline', updateStatus);
    updateStatus();
    function updateStatus(event) {
      var condition = navigator.onLine ? 'Internet Status:  Online' : 'offline';
      var displayOnlineStatus = document.getElementById('online-status');
      displayOnlineStatus.innerHTML = condition;
    };
  </script>"
  ?>
  </tbody>
</table>

</html>

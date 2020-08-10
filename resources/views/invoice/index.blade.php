@extends('layouts.app')
@section('content')
<h1>Customer Invoice</h1>
<div class="card">
    <div class="card-header">
      <h2>Customer Info</h2>
    </div>
    <div class="card-body">
      <ul>
          <li><strong> Customer Name:</strong> {{ Auth::user()->name }}</li>
      </ul>
    </div>
  </div>
  
    
      <h2>Order Details</h2>
    
    
      <button id="btn" class="btn btn-primary">Add New</button>
      <input type="hidden" id="count" name="count" value="0">
      <table class="table "id="MyTable">
        <thead>
            <tr>
              <th scope="col">Product Name</th>
              <th scope="col">Unit Price</th>
              <th scope="col">Quantity</th>
              <th scope="col"> Total</th>
              <th scope="col"> Action</th>
            </tr>
          </thead>
          <tbody class="dcontainer">
            <input type="hidden" id="count" name="custId" value="0">
            

          </tbody>
          <tfoot>
              <tr>
                <td colspan="3"><strong>Sub Total: </strong></td>
                <td id="sbttl"></td>
              </tr>
              <tr>
                <td colspan="3"><strong>Discount: </strong></td>
                <td ><input type="number" id="dscnt" value="0"></td>
              </tr>
              <tr>
                <td colspan="3"><strong>Tax: </strong></td>
                <td ><input type="number" id="tax" value="0"></td>
              </tr>
              
              <tr>
                <td colspan="3"><strong>Grand Total: </strong></td>
                <td id="grand"></td>
              </tr>
              
          </tfoot>
      </table>
    
  
@endsection
@section('script')
<script>
  $('#btn').click(function(){
        
      var row=`<tr >`
            var count=$('#count').val();
           
            row+=`<td>
                <select name="product" id="product_`+count+`" onchange="fnChangetheValue(`+count+`);">
                <option value="" selected disabled hidden>Choose here</option>
                @foreach ($product as $item)
                <option value="{{$item->id}}"price="{{$item->price}}" >{{$item->name}}</option>    
                @endforeach
            </select>
            </td>`
            row+=`<td>
                <input type="number" id="price_`+count+`" name="price" value="0">
            
            </td>`
            row+=`<td>
                <input type="number" id="unit_`+count+`" name="unit" value="0" onkeyup="fnUpdateTotal(`+count+`);">
            
            </td>`
            row+=`<td>
                <input type="number" class="tclass" id="total_`+count+`" name="total" value="0">
            
            </td>`

            row+=`<td><button class="btn btn-danger"id="DeleteButton">delete</td>`
            row+="</tr>"
      $( "tbody.dcontainer" )
            .append(row);
            count++ ;

            $('#count').val(count);
      //console.log('clicked');
  });
   $("#MyTable").on("click", "#DeleteButton", function() {
    $(this).closest("tr").remove();
 });
// $("#MyTable").on("change", "#product", function() {
//     var p=$(this).find(':selected').attr('price');
//     $(this).parent().parent().find('#price1').val(p);
//     var q=p*$(this).parent().parent().find('#unit').val();
//    $(this).parent().parent().find('#total').val(q);
//     console.log(q);
    
// });
// $("#unit").keyup( function() {
//     console.log(this.val());
// });



function fnChangetheValue(row){
    // c
    var p=$('#product_'+row).find(':selected').attr('price');
    // console.log(p);
    $('#price_'+row).val(p);

}


function fnUpdateTotal(row)
{
    var price = $('#price_'+row).val();
    var qnt = $('#unit_'+row).val();
     $('#total_'+row).val(price*qnt);
     totalCalculate();


}
function totalCalculate(){
    var sum=0;
    $(".tclass").each(function() {
    sum+=parseInt($(this).val());
});
$('#sbttl').html(sum);
$('#grand').html(sum);
}
$('#dscnt').keyup(function(){
    var b=parseInt($('#dscnt').val());
    if($(this).val()==""){
        b=0;
    }
    console.log(b);
    var a=parseInt($('#sbttl').html());
    //var b=$('#dscnt').val();
   
    var l=parseInt($('#tax').val());

    $('#grand').html((a-b)+l);
   
});


$('#tax').keyup(function(){
    var l=parseInt($('#tax').val());
    if($(this).val()==""){
       l=0;
    }
    var a=parseInt($('#sbttl').html());
    //var b=$('#dscnt').val();
    var b=parseInt($('#dscnt').val());
    

    $('#grand').html((a-b)+l);
});
</script>
@endsection

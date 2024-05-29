<div class="text-center">
    <h2>{{ __('Other Informations') }}</h2>
</div>

<!-- start iteration -->
<div class="row">
<?php
$otherInfoArr = json_decode($data['Customer']->others, true);
$numOfCols = 3;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
$content = '';
foreach ($otherInfoArr as $infoKey=>$infoVal){
 if(!is_array($infoVal)){
    if($infoVal != "" || $infoVal != null){
        ?>
        <div class="col-md-{{$bootstrapColWidth}} row">
            <div class="col-md-4">{{$infoKey}} :</div>
            @if(str_contains($infoKey, 'phone') || str_contains($infoKey, 'no_ec') || str_contains($infoKey, 'Contact Phone') || str_contains($infoKey, 'no_kantor') || str_contains($infoKey, 'ResidenceAreaPhone1') || str_contains($infoKey, 'EmergencyAreaPhone2') || str_contains($infoKey, 'EmergencyPhone2') || str_contains($infoKey, 'CompanyPhone2') || str_contains($infoKey, 'no_kantor'))
            <div class="col detail_phone" data-infokey="{{$infoKey}}"><a href="sip:{{strip_tags($infoVal)}}">{{strip_tags($infoVal)}}</a></div>
            <input type="hidden" name="idCustomer" id="idCustomer" value="{{$data['Customer']->id}}">
            @else
            <div class="col">{{strip_tags($infoVal)}}</div>
            @endif
        </div>
        <?php 
        $rowCount++; 
    }    
    
    if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
 }
    
}
?>
</div>
<!-- end iteration -->
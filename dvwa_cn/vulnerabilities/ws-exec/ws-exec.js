/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var serviceURL = './ws-commandinj.php';
//var validIPRegex = '/(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/';
var validIPRegex = '^\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}$';

// Code for the Low Level.
// No validation on either end.
function beginPingLow() {
    var soapMessage = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><pingAddressLow xmlns="http://localhost"><address>' + document.getElementById('pingAddress').value + '</address></pingAddressLow></soap:Body></soap:Envelope>';
    document.getElementById('pingButton').disabled=true;
    $.ajax({
        url: serviceURL,
        type: "POST",
        dataType: "xml",
        data: soapMessage,
        complete: displayPingLow,
        contentType: "text/xml; charset=\"utf-8\""
    });
}

// Code for the Medium Level. 
// Still using the low (no validation) code on server side, validating client side.
function beginPingMedium() {
    var address = document.getElementById('pingAddress').value;
    if (address.match(validIPRegex)){
        var soapMessage = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><pingAddressLow xmlns="http://localhost"><address>' + address + '</address></pingAddressLow></soap:Body></soap:Envelope>';
        document.getElementById('pingButton').disabled=true;
        $.ajax({
            url: serviceURL,
            type: "POST",
            dataType: "xml",
            data: soapMessage,
            complete: displayPingLow,
            contentType: "text/xml; charset=\"utf-8\""
        });
    } else {
        document.getElementById('results').innerHTML = '<pre>错误: 请输入一个有效的ip地址。</pre>';
        document.getElementById('pingButton').disabled=false;
    }
}

// This function displays the results from the low and medium levels.
function displayPingLow(request, status){
    var response = "<pre>";
    $(request.responseXML).find('pingAddressLowResponse').each(function(){
        response += $(this).find('return').text();
    });
    response += "</pre>";
    document.getElementById('results').innerHTML = response;
    document.getElementById('pingButton').disabled=false;
}

// Code for the High level.
// Validation occurs both client and server side.
function beginPingHigh() {
    var address = document.getElementById('pingAddress').value;
    if (address.match(validIPRegex)){
        var soapMessage = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><pingAddressHigh xmlns="http://localhost"><address>' + address + '</address></pingAddressHigh></soap:Body></soap:Envelope>';
        document.getElementById('pingButton').disabled=true;
        $.ajax({
            url: serviceURL,
            type: "POST",
            dataType: "xml",
            data: soapMessage,
            complete: displayPingHigh,
            contentType: "text/xml; charset=\"utf-8\""
        });
    } else {
        document.getElementById('results').innerHTML = '<pre>错误: 请输入一个有效的ip地址。</pre>';
        document.getElementById('pingButton').disabled=false;
    }
}

function displayPingHigh(request, status){
    var response = "<pre>";
    $(request.responseXML).find('pingAddressHighResponse').each(function(){
        response += $(this).find('return').text();
    });
    response += "</pre>";
    document.getElementById('results').innerHTML = response;
    document.getElementById('pingButton').disabled=false;
}
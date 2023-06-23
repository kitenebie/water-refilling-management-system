
const number_yearlySales = parseFloat($('#yearlySales').text());
const formattedNumber_yearlySales = new Intl.NumberFormat("en-US", {
  thousandSeparator: ",",
  decimalPlaces: 2,
  rounding: true,
  maximumFractionDigits: 2
}).format(number_yearlySales);
$('#yearlySales').text(formattedNumber_yearlySales);

const number_adminStocks = parseFloat($('#adminStocks').text());
const formattedNumber_adminStocks = new Intl.NumberFormat("en-US", {
  thousandSeparator: ",",
  decimalPlaces: 2,
  rounding: true,
}).format(number_adminStocks);
$('#adminStocks').text(formattedNumber_adminStocks);

const number_RecentOrders = parseFloat($('#RecentOrders').text());
const formattedNumber_RecentOrders = new Intl.NumberFormat("en-US", {
  thousandSeparator: ",",
  decimalPlaces: 2,
  rounding: true,
}).format(number_RecentOrders);
$('#RecentOrders').text(formattedNumber_RecentOrders);




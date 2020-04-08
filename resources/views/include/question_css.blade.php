<style>
table.a{
  width: 100%;
  border-collapse:separate;
  border-spacing: 0;
}

table.a th:first-child{
  border-radius: 5px 0 0 0;
}

table.a th:last-child{
  border-radius: 0 5px 0 0;
  border-right: 1px solid #3c6690;
}

table.a th{
  text-align: center;
  border-left: 1px solid #3c6690;
  border-top: 1px solid #3c6690;
  border-bottom: 1px solid #3c6690;
  box-shadow: 0px 1px 1px rgba(255,255,255,0.3) inset;
  padding: 10px 0;
}

table.a td{
  text-align: center;
  border-left: 1px solid #a8b7c5;
  border-bottom: 1px solid #a8b7c5;
  border-top:none;
  box-shadow: 0px -3px 5px 1px #eee inset;
  padding: 10px 0;
}

table.a td:last-child{
  border-right: 1px solid #a8b7c5;
}

table.a tr:last-child td:first-child {
  border-radius: 0 0 0 5px;
}

table.a tr:last-child td:last-child {
  border-radius: 0 0 5px 0;
}
</style>
var dataGrid= {

  currentPage:1,
  limit:10,


  buildQueryStr: function()
  {
    return "?page="+this.currentPage+"&limit="+this.limit;
  },

  isEnterKey: function(event)
  {

    key = event.which;

    if (window.event) {
      key = window.event.keyCode; //IE
    }
    console.log(key);
    if(key==13)
    {
      return true;
    }
    return false;
  },

  goToPrevPage: function()
  {

    this.goToPage(null,--this.currentPage);

  },

  goToNextPage: function()
  {
    this.goToPage(null,++this.currentPage);
  },

  goToPage: function(event,pageNumber)
  {
    if(event&&!this.isEnterKey(event))return;
    this.currentPage=pageNumber;

    var currentUrl=window.location.pathname;

    currentUrl=currentUrl.split("?")[0];
    console.log("Go To Page!!");

    window.location=currentUrl+this.buildQueryStr();
  }

}
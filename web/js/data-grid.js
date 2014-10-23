var dataGrid= {

  currentPage:1,
  limit:10,
    order:null,
    dir:"desc",


  buildQueryStr: function()
  {
    var url= "?page="+this.currentPage+"&limit="+this.limit;
      if(this.order&&this.dir)url+="&orderBy="+this.order+"&dir="+this.dir;
      return url;
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
  },

  changeLimit: function(limit)
  {
      this.limit=limit;
      var currentUrl=window.location.pathname;

      currentUrl=currentUrl.split("?")[0];
      console.log("changeLimit!!");

      window.location=currentUrl+this.buildQueryStr();
  },

  orderBy: function(order)
  {

      this.order=order;

      console.log(this.dir+" "+this.order);

      var currentUrl=window.location.pathname;

      currentUrl=currentUrl.split("?")[0];
      console.log("GOrder By!!");

      window.location=currentUrl+this.buildQueryStr();

  }

}
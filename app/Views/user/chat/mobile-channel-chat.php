<div class="container d-block d-xl-none d-lg-none d-md-none d-sm-block content"
  id="mobile-channel-chat">
  <ul class="nav border-0 flex-column"
    id="mobile-channel-list">
    <li class="nav-item py-4 p-2">
      <input type="text" 
        class="form-control input-ci-chat" 
        placeholder="Cari channel ..." 
        name="search" 
        onkeyup="mobileChannel.searchChannel(event)"> 
    </li>

    <li class="nav-item py-4 p-5 text-center"
      id="mobile-not-found-channel">
      <img src="<?= base_url('/assets/images/channel.png');?>"
        class="img-fluid">

      <h5 class="mt-2 text-mode"> Channel Chat </h5>

      <p style="font-size:13px"
        class="text-mode">
        Tidak Ditemukan Channel Chat
      </p>
    </li>    
  </ul>
</div>    

<script>
const mobileChannel = {
  data : {
    channels : [],
    isStop : false,
    interval : null,
    page : 1,
    last_page : 1,
    search : null
  },

  showContentChat(id,user_id,username,email,photo){    
   mobileContentChat.showContent(id,user_id,username,email,photo);
  },

  renderChannel : function(){      
    $("#mobile-channel-list > .mobile-channel-list").remove();
   
    if(this.data.channel.length){
      var html = ``;
      var mode = localStorage.getItem('mode-ci-chat');

      for(i=0;i<this.data.channel.length;i++){
        html += `
        <li class="nav-item p-2 mobile-channel-list" 
          style="cursor:pointer"
          onclick="mobileChannel.showContentChat('${this.data.channel[i].id}','${this.data.channel[i].user.id}','${this.data.channel[i].user.username}','${this.data.channel[i].user.email}','${this.data.channel[i].user.photo}')">
          <div class="d-flex flex-column">
            <div style="font-size:15px;${mode == 'light' ? 'color:black' : 'color:white'}">
              <span class='float-left'>
                <img class="img-fluid img-rounded" 
                  style="width:50px"
                  src="<?= base_url('/assets/images/users/');?>/${this.data.channel[i].user.photo}" />
                  ${this.data.channel[i].user.username}
              </span>                            
              <span class='float-right badge badge-primary' 
                style="font-size:10px">              
                C${this.data.channel[i].id}
              </span>           
            </div>     
            <div class="mt-1" 
              style="font-size:13px;${mode == 'light' ? 'color:black' : 'color:white'}">
              ${this.setMessage(this.data.channel[i].message)}
            </div>
          </div>
        </li>      
        `
      }

      html += `
        <li class="nav-item p-2 mobile-channel-list" 
          style="font-size:13px">
          ${this.isBefore()}      
          ${this.isNext()}          
        </li>
      `;

      $("#mobile-channel-list").append(html);
      $("#mobile-not-found-channel").hide();
    }else{
      $("#mobile-not-found-channel").show();
    }
  },

  callChannel : function(){               
    var self = this;

    var url  = "<?= base_url('/channel');?>";

    url += "?page="+self.data.page;

    if(self.data.search){
      url += "&search="+self.data.search;
    }

    $.ajax({
      method : "get",
      url : url, 
      success: function(res){   
        self.data.last_page = res.data.last_page;              
        self.data.channel = res.data.channels;      
        self.renderChannel();        
        self.stopInterval();        

        if(self.data.isStop === false){
          self.data.interval = setInterval(self.callChannel.bind(self),parseInt("<?= $_ENV['app.interval_channel'];?>")*1000);                                    
        }
      },
      error: function(res){
        console.log('Terjadi Kesalahan');
      }
    });
  },

  searchChannel : function(evt){
    this.data.search = evt.target.value;
    this.isLoading();
  },

  stopInterval : function(){
    clearInterval(this.data.interval);    
    this.data.interval = null;
  },

  nextPage : function(){        
    if(this.data.page < this.data.last_page){
      this.isLoading();
      this.data.page = this.data.page + 1;
    }  
  },

  beforePage : function(){    
    if(this.data.page > 1){     
      this.isLoading();
      this.data.page = this.data.page - 1;
    }
  },

  isNext : function(){
    if(this.data.page < this.data.last_page){
      var mode = localStorage.getItem('mode-ci-chat');
      return `
        <div class="float-right"
            style="cursor:pointer;${mode == 'light' ? 'color:black' : 'color:white'}"
            onclick="mobileChannel.nextPage()">
            Selanjutnya
        </div>
      `;
    }else{
      return "";
    }
  },

  isBefore :  function(){
    if(this.data.page > 1){
      var mode = localStorage.getItem('mode-ci-chat');
      return `
        <div class="float-left"
          style="cursor:pointer;${mode == 'light' ? 'color:black' : 'color:white'}"
          onclick="mobileChannel.beforePage()">
          Sebelumnya
        </div>
      `;
    }else{
      return "";
    }
  },

  setMessage : function(message){
    if(message === null){
      return 'Belum Ada Pesan'
    }else{
      if(message.type === 'file'){
        return "<i class='fa fa-file'></i> File";
      }else if(message.type === 'image'){
        return "<i class='fa fa-image'></i> Gambar";
      }else{        
        var str = message.message;
        var jml = 50;

        if(!str){
          return str;
        }
      
        if(str.length <= 0){
          return str;
        }
     
        if (str.length <= jml) {
          return str
        }  

        return str.slice(0, jml) + ' ...';     
      }
    }
  },

  isLoading : function(){
    var mode = localStorage.getItem('mode-ci-chat');

    $("#mobile-not-found-channel").hide();

    $("#mobile-channel-list > .mobile-channel-list").remove();
      
    $("#mobile-channel-list").append(`
      <li class="nav-item p-2 mobile-channel-list text-center"
        style="${mode == 'light' ? 'color:black' : 'color:white'}">
        <i class='fa fa-spinner fa-spin fa-2x'></i>
        <br />
        Loading         
      </li>
    `); 
  },

  isMobile : function(){
    var win = $(window);

    if (win.width() < 599) {  
      this.data.isStop = false;      
      this.callChannel();
    }else if(win.width() > 600 && win.width() < 968){   
      this.data.isStop = false;      
      this.callChannel();
    }else{                              
      this.data.isStop = true;
      this.stopInterval();
    }
  }
}

$(window).on("load",function(){
  mobileChannel.isMobile();
});

$(window).on('resize', function() {
  mobileChannel.isMobile();
});
</script>
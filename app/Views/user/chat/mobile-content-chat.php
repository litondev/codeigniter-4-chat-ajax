<div class="container d-none d-xl-none d-lg-none d-md-none d-sm-none content pl-0 pr-0"
  style="border-radius: 15px 15px 0px 0px"
  id="mobile-content-chat">
  <div class="pl-3 pr-3 pt-2 pb-2 clearfix"
    style="border-radius: 15px 15px 15px 15px;background:#333333;color:white">    
    <div class="float-left d-flex flex-row">
      <div class="d-flex justify-content-center">
        <img id="mobile-content-chat-user-photo" 
          src=""
          width="50px">
      </div>
      <div class="d-flex flex-column">
        <div id="mobile-content-chat-user-username"
          style="font-size:13px"></div>
        <div id="mobile-content-chat-user-email"
          style="font-size:10px"></div>
      </div>
    </div>

    <div class="float-right">
      <i class="fa fa-caret-left fa-2x"
        onclick="mobileContentChat.backToChannel()"></i>

      <!--     
        <div class="btn-group dropleft">
          <span style="cursor:pointer" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Opsi
          </span>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Blokir</a>
            <a class="dropdown-item" href="#">Laporkan</a>
          </div> 
        </div>
      -->
    </div>
  </div>

  <div class="pt-3 pb-3 pl-4 pr-4" style="height:430px">
    <div class="row"  
      style="overflow:auto;max-height:400px"
      id="mobile-content-chats">       
    </div>
  </div>

  <div class="pl-4 pr-4 mt-3 clearfix"
    style="border-radius:0px 0px 15px 15px;position:fixed;bottom:0px">
    <form onsubmit="mobileContentChat.sendMessage(event)" 
      id="mobile-form-message">      
      <div class="row pt-2 pb-2">
          <div class="w-5 pt-2">
            <i class="fa fa-image fa-1x"
              style="cursor:pointer"
              onclick="mobileContentChat.chooseFile()"></i>                      
            <input type="file" 
              style="display:none" 
              name="mobile-file">
          </div>
      
          <div class="col-9">
            <input type="text" class="form-control input-ci-chat" placeholder="Message . . ."
              style="border-radius:20px"
              name="mobile-message">         
          </div>

          <div class="w-5">
            <button class="btn btn-primary btn-block"
              style="border-radius:10px 10px 10px 10px;background:#c738b0;border:0px solid white">
              <i class="fab fa-telegram fa-1x"></i>
            </button>
          </div>
      </div>          
    </form>
  </div>
</div>


<script>
const mobileContentChat = {
  data : {
    id : null,
    page : 1,
    last_page : 1,
    chat : [],
    interval : null,
    isStop : false,
    height : 0,
    user : {
      username : null,
      user_id : null,
      photo : null,
      email : null
    }
  },

  chooseFile : function(){
    $("input[name=mobile-file]").click();    
  },

  sendMessage : function(evt){
    evt.preventDefault();

    if(!$("input[name=mobile-message]").val()){
      toastr.warning('Message harus diisi');
      return false;
    }

    var xhr = new XMLHttpRequest();     
    var data = new FormData();
    var file = document.querySelector("input[name=mobile-file]").files[0];

    data.append('message',$("input[name=mobile-message]").val());
    
    if(file){
      data.append('file', file, file.name);
    }

    xhr.open('POST',"<?= base_url('/chat/message');?>/"+this.data.id, true);  
    xhr.send(data);
    xhr.onload = function () {
        document.getElementById("mobile-form-message").reset();       
        var response = JSON.parse(xhr.responseText);
        if(xhr.status === 201){
          toastr.success('Berhasil Mengirim Pesan');
        }else{          
          toastr.error(response.failed ? response.failed : 'Terjadi Kesalahan');
        }
    };
  },

  nextPage : function(){        
    if(this.data.page < this.data.last_page){    
      this.data.page = this.data.page + 1;
    }  
  },

  beforePage : function(){    
    if(this.data.page > 1){           
      this.data.page = this.data.page - 1;
    }
  },

  showContent : function(id,user_id,username,email,photo){
    this.stopInterval();

    this.data.id = id;
    this.data.isStop = false;
    this.data.height = $(window).height();

    this.data.user = Object.assign({},this.data.user,{
      username : username,
      email :  email,
      photo : photo,
      user_id : user_id
    });

    this.data.last_page = 1;
    this.data.page = 1;
    this.data.chat = [];

    $("#mobile-content-chat-user-photo").attr("src","<?= base_url('assets/images/users/');?>/"+this.data.user.photo);
    $("#mobile-content-chat-user-username").html(this.data.user.username);
    $("#mobile-content-chat-user-email").html(this.data.user.email);
    $("#mobile-content-chat").removeClass("d-none d-xl-none d-lg-none d-md-none d-sm-none").addClass("d-block d-xl-none d-lg-none d-md-none d-sm-block");
    $("#mobile-channel-chat").removeClass("d-block d-xl-none d-lg-none d-md-none d-sm-block").addClass("d-none d-xl-none d-lg-none d-md-none d-sm-none");

    this.callChat();
  },

  renderRightChat : function(data){
    var message = data.message;

    if(data.type == 'image'){
      message = "<img src='<?= base_url('assets/files/');?>/"+message+"' width='200px'/>";
    }else if(data.type == 'file'){
      message = "<a href='<?= base_url('assets/files/');?>/"+message+"' target='blank' style='color:white'>File</a>"
    }

    $("#mobile-content-chats").append(`
    <div class="col-12 mb-3 mobile-list-content-chat">                         
      <div class="float-right">
        <div style="background:gray;padding:10px;border-radius:30px 30px 0px 30px;color:white">
          ${message}
        </div>
      </div>
    </div>`);
  },

  renderLeftChat : function(data){
    var message = data.message;
    
    if(data.type == 'image'){
      message = "<img src='<?= base_url('assets/files/');?>/"+message+"' width='200px'/>";
    }else if(data.type == 'file'){
      message = "<a href='<?= base_url('assets/files/');?>/"+message+"' target='blank' style='color:white'>File</a>"
    }

    $("#mobile-content-chats").append(`
      <div class="col-12 mb-3 mobile-list-content-chat">          
        <div class="float-left">
          <div style="background:rgba(254,120,205,40);padding:10px;border-radius:30px 30px 30px 0px;color:white">
            ${message}
          </div>
        </div>
      </div>`);
  },

  renderChat : function(){
    if(this.data.chat.length){
      var USERID = "<?= session('user')['id'];?>";

      $(".mobile-list-content-chat").remove();

      if(this.data.page > 1){
        $("#mobile-content-chats").append(`
          <div class="col-12 mb-3 mt-3 mobile-list-content-chat text-center"
            style="cursor:pointer"
            onclick="mobileContentChat.beforePage()">
            <span class='badge badge-primary'>Selanjutnya</span>
          </div>
        `);
      }

      for(var i=0;i<this.data.chat.length;i++){      
        if(this.data.chat[i].channel.accepter_id == USERID){       
          if(this.data.chat[i].sender == 'accepter'){
            this.renderRightChat(this.data.chat[i]);
          }else{
            this.renderLeftChat(this.data.chat[i]);;
          }
        }else{
          if(this.data.chat[i].sender == 'accepter'){
            this.renderLeftChat(this.data.chat[i]);
          }else{
            this.renderRightChat(this.data.chat[i]);;
          }
        }
      }

      if(this.data.page < this.data.last_page){
        $("#mobile-content-chats").append(`
          <div class="col-12 mb-3 mt-3 mobile-list-content-chat text-center pb-2"
            style="cursor:pointer"
            onclick="mobileContentChat.nextPage()">
            <span class='badge badge-primary'>Sebelumnya</span>
          </div>
        `);
      }
    }else{
      $(".mobile-list-content-chat").remove();
    }
  },

  callChat : function(){    
    var self = this;
    var url  = "<?= base_url('/chat');?>/"+this.data.id;
    url += "?page="+self.data.page;  

    $.ajax({
      method : "get",
      url : url, 
      success: function(res){   
        self.data.last_page = res.data.last_page;              
        self.data.chat = res.data.chat;      
        self.renderChat();        
        self.stopInterval();              
        if(self.data.isStop === false){      
          self.data.interval = setInterval(self.callChat.bind(self),parseInt("<?= $_ENV['app.interval_chat'];?>")*1000);                  
        }
      },
      error: function(res){
        console.log('Terjadi Kesalahan');
      }
    });
  },

  stopInterval : function(){
    clearInterval(this.data.interval);    
    this.data.interval = null;
  },


  backToChannel : function(){    
    var height = $(window).height();

    if(this.data.height == height){
      $("#mobile-channel-chat").removeClass("d-none d-xl-none d-lg-none d-md-none d-sm-none").addClass("d-block d-xl-none d-lg-none d-md-none d-sm-block");
      $("#mobile-content-chat").removeClass("d-block d-xl-none d-lg-none d-md-none d-sm-block").addClass("d-none d-xl-none d-lg-none d-md-none d-sm-none");
      this.data.isStop = true;
      this.stopInterval();  
    }

    this.data.height = height;
  }
}

$(window).on('resize', function() {
  mobileContentChat.backToChannel();
});
</script>
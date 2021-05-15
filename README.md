<h1>Codeigniter 4 Chat Ajax</h1>

<b>Purpose : </b>
<p>
   I make this respoitory for my self to increase my skill
</p>

<b>Install : </b>
 <ul>
  <li>
   <b>composer install</b>
   <b>(*Make sure you already have composer first)</b>
  </li>
  <li>
   <b>Copy example.env to .env</b>
  </li>
  <li>
   <b>Setting file .env</b> 
     
   <p>
      <b>Create Database First</b>
   </p>    
   
   <p>Edit Database Section</p>   
   
   <p>
    database.default.hostname = {your host/address database}  <br/>
    database.default.database = {your database name}  <br/>
    database.default.username = {your username database} <br/>
    database.default.password = {your password database} <br/>
    database.default.DBDriver = {your database management}  <br/>
   </p>

  </li>
  <li>
   <b>Migrate Database</b>
   <p>php spark migrate</p>
  </li>
  <li>
   <b>Seed Database</b>
   <p>php spark db:seed AllSeeder</p>
  </li>
  <li>
   <b>Run Serve</b>
   <p>php spark server</p>
  </li>  
 </ul>
<b>  Login Data User :  </b> 
<p> See the seeder user file </p>

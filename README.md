<h1>Codeigniter 4 Chat Ajax</h1>

<b>Purpose</b>
<p>
   I make this respoitory for my self to increase my skill
</p>

<b>Install</b>
 <ul>
  <li>
   <b>composer install</b>
   <b>(*Make sure you already have composer first)</b>
  </li>
  <li>
   <b>Copy example.env to .env</b>
  </li>
  <li>
   <b>edit .env</b> 
   <b>Create Database First</b>
   <p>Edit Database Section</p>   
   <p>
    database.default.hostname = localhost <br/>
    database.default.database = NAMADATABASE <br/>
    database.default.username = USERNAMEDATABASE <br/>
    database.default.password = PASSWORDDATABASE <br/>
    database.default.DBDriver = MySQLi <br/>
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
<b> 

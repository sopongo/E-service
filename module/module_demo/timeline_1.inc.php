<style type="text/css"> 

section#timeline {
  width: 80%;
  margin: 20px auto;
  position: relative;
}
section#timeline:before {
  content: '';
  display: block;
  position: absolute;
  left: 50%;
  top: 0;
  margin: 0 0 0 -1px;
  width: 2px;
  height: 100%;
  background: rgba(255,255,255,0.2);
}
section#timeline article {
  width: 100%;
  margin: 0 0 20px 0;
  position: relative;
}
section#timeline article:after {
  content: '';
  display: block;
  clear: both;
}
section#timeline article div.inner {
  width: 40%;
  float: left;
  margin: 5px 0 0 0;
  border-radius: 6px;
}
section#timeline article div.inner span.date {
  display: block;
  width: 60px;
  height: 50px;
  padding: 5px 0;
  position: absolute;
  top: 0;
  left: 50%;
  margin: 0 0 0 -32px;
  border-radius: 100%;
  font-size: 12px;
  font-weight: 900;
  text-transform: uppercase;
  background: #25303B;
  color: rgba(255,255,255,0.5);
  border: 2px solid rgba(255,255,255,0.2);
  box-shadow: 0 0 0 7px #25303B;
}
section#timeline article div.inner span.date span {
  display: block;
  text-align: center;
}
section#timeline article div.inner span.date span.day {
  font-size: 10px;
}
section#timeline article div.inner span.date span.month {
  font-size: 18px;
}
section#timeline article div.inner span.date span.year {
  font-size: 10px;
}
section#timeline article div.inner h2 {
  padding: 15px;
  margin: 0;
  color: #fff;
  font-size: 20px;
  text-transform: uppercase;
  letter-spacing: -1px;
  border-radius: 6px 6px 0 0;
  position: relative;
}
section#timeline article div.inner h2:after {
  content: '';
  position: absolute;
  top: 20px;
  right: -5px;
  	width: 10px; 
	  height: 10px;
  -webkit-transform: rotate(-45deg);
}
section#timeline article div.inner p {
  padding: 15px;
  margin: 0;
  font-size: 14px;
  background: #fff;
  color: #656565;
  border-radius: 0 0 6px 6px;
}
section#timeline article:nth-child(2n+2) div.inner {
  float: right;
}
section#timeline article:nth-child(2n+2) div.inner h2:after {
  left: -5px;
}
section#timeline article:nth-child(1) div.inner h2 {
  background: #e74c3c;
}
section#timeline article:nth-child(1) div.inner h2:after {
  background: #e74c3c;
}
section#timeline article:nth-child(2) div.inner h2 {
  background: #2ecc71;
}
section#timeline article:nth-child(2) div.inner h2:after {
  background: #2ecc71;
}
section#timeline article:nth-child(3) div.inner h2 {
  background: #e67e22;
}
section#timeline article:nth-child(3) div.inner h2:after {
  background: #e67e22;
}
section#timeline article:nth-child(4) div.inner h2 {
  background: #1abc9c;
}
section#timeline article:nth-child(4) div.inner h2:after {
  background: #1abc9c;
}
section#timeline article:nth-child(5) div.inner h2 {
  background: #9b59b6;
}
section#timeline article:nth-child(5) div.inner h2:after {
  background: #9b59b6;
}
</style>


<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">

<div class="card-header">
    <h5 class="display-10 d-inline-block font-weight-bold"><?PHP echo $title_act;?></h5>
    <div class="card-tools">
    <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard v1</li>
    </ol>
    </div>
</div>


<div class="card-body">


<section id="timeline">
  <article>
    <div class="inner">
      <span class="date">
        <span class="day">30<sup>th</sup></span>
        <span class="month">Jan</span>
        <span class="year">2014</span>
      </span>
      <h2>The Title</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis rutrum nunc, eget dictum massa. Nam faucibus felis nec augue adipiscing, eget commodo libero mattis.</p>
    </div>
  </article>
  <article>
    <div class="inner">
      <span class="date">
        <span class="day">26<sup>th</sup></span>
        <span class="month">Jan</span>
        <span class="year">2014</span>
      </span>
      <h2>The Title</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis rutrum nunc, eget dictum massa. Nam faucibus felis nec augue adipiscing, eget commodo libero mattis.</p>
    </div>
  </article>
  <article>
    <div class="inner">
      <span class="date">
        <span class="day">26<sup>th</sup></span>
        <span class="month">Jan</span>
        <span class="year">2014</span>
      </span>
      <h2>The Title</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis rutrum nunc, eget dictum massa. Nam faucibus felis nec augue adipiscing, eget commodo libero mattis.</p>
    </div>
  </article>
  <article>
    <div class="inner">
      <span class="date">
        <span class="day">26<sup>th</sup></span>
        <span class="month">Jan</span>
        <span class="year">2014</span>
      </span>
      <h2>The Title</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis rutrum nunc, eget dictum massa. Nam faucibus felis nec augue adipiscing, eget commodo libero mattis.</p>
    </div>
  </article>
  <article>
    <div class="inner">
      <span class="date">
        <span class="day">26<sup>th</sup></span>
        <span class="month">Jan</span>
        <span class="year">2014</span>
      </span>
      <h2>The Title</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis rutrum nunc, eget dictum massa. Nam faucibus felis nec augue adipiscing, eget commodo libero mattis.</p>
    </div>
  </article>
</section>


</div><!-- /.card-body -->

</div><!-- /.card -->

</section>
<!-- /.content -->

<script>
    
</script>
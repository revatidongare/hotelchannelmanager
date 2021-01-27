<?php
$date_in = isset($_POST['date_in']) ? $_POST['date_in'] : date('Y-m-d');
$date_out = isset($_POST['date_out']) ? $_POST['date_out'] : date('Y-m-d',strtotime(date('Y-m-d').' + 3 days'));
?>

	 <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                    	 <h1 class="text-uppercase text-white font-weight-bold">Rooms</h1>
                        <hr class="divider my-4" />
                    </div>
                    
                </div>
            </div>
        </header>

<section class="page-section bg-dark">
		
		<div class="container">	
				<div class="col-lg-12">	
						<div class="card">
							<div class="card-body">	
									<form action="index.php?page=list" id="filter" method="POST">
			        					<div class="row">
			        						<div class="col-md-3">
			        							<label for="">Chech-in Date</label>
			        							<input type="text" class="form-control datepicker" name="date_in" autocomplete="off" value="<?php echo isset($date_in) ? date("Y-m-d",strtotime($date_in)) : "" ?>">
			        						</div>
			        						<div class="col-md-3">
			        							<label for="">Chech-out Date</label>
			        							<input type="text" class="form-control datepicker" name="date_out" autocomplete="off" value="<?php echo isset($date_out) ? date("Y-m-d",strtotime($date_out)) : "" ?>">
			        						</div>
			        						<div class="col-md-3">
			        							<br>
			        							<button class="btn-btn-block btn-primary mt-3">Check Availability</button>
			        						</div>

			        					</div>
			        				</form>
							</div>
						</div>	

						<hr>	
						
						<?php 
						$query = "SELECT * FROM `tbl_events` WHERE `start` BETWEEN '$date_in' AND '$date_out' and `end` BETWEEN '$date_in' AND '$date_out'";
                             include 'config.php';
                             $stmt=$conn->prepare($query);
                             $stmt->execute();
                             $result=$stmt->fetchAll();
                             $conn=null;
                                  
                             foreach($result as $room){
                             	$id = $room['category'];

                             	$que = "SELECT * FROM `room_categories` WHERE `id` = $id";
                             include 'config.php';
                             $stmt1=$conn->prepare($que);
                             $stmt1->execute();
                             $result1=$stmt1->fetchAll();
                             $conn=null;

                             foreach($result1 as $room_categories){

                  ?>
						
						 <!-- $cat = $conn->query("SELECT * FROM room_categories");
						$cat_arr = array();
						while($row = $cat->fetch_assoc()){
							$cat_arr[$row['id']] = $row;
						}
						$qry = $conn->query("SELECT distinct(category_id),category from tbl_events where id in (SELECT * from `tbl_events` where `start` BETWEEN '$date_in' and '$date_out' and `end` BETWEEN '$date_in' and '$date_out')");
							while($row= $qry->fetch_assoc()):

						?> -->
						<div class="card item-rooms mb-3">
							<div class="card-body">
								<div class="row">
								<div class="col-md-5">
									<img src="assets/img/<?php echo $room_categories['cover_img'] ?>" alt="">
								</div>
								<div class="col-md-5" height="100%">
									<h3><b>Price: ₹<?php echo $room_categories['price']?></b><span> / per day</span></h3>

									<h4><b>
										<?php $dateinn = $room['start'] ?>
										Availability Date : <?php echo date($dateinn)?>
									</b></h4>

									<h4><b>
										Available Room : <?php echo $room['title'] ?>
									</b></h4>

									<h4><b>
										Room Type: <?php echo $room_categories['name'] ?>
									</b></h4>
									<div class="align-self-end mt-5">
										<button class="btn btn-primary  float-right book_now" type="button" data-id1="<?php echo $room['id'] ?>" data-id="<?php echo $room['category'] ?>">Book now</button>
									</div>
								</div>
							</div>

							</div>
						</div>
						<?php }
					}?>
				</div>	
		</div>	
</section>
<style type="text/css">
	.item-rooms img {
    width: 23vw;
}
</style>
<script>
	$('.book_now').click(function(){
		uni_modal('Book','admin/book.php?id='+$(this).attr('data-id1')+'&in=<?php echo $date_in ?>&out=<?php echo $date_out ?>&cid='+$(this).attr('data-id'))
	})
</script>



<!-- SELECT * FROM `tbl_events` WHERE `start` BETWEEN '2021-01-29' AND '2021-01-31' and `end` BETWEEN '2021-01-29' AND '2021-01-31' and Category = 3 -->
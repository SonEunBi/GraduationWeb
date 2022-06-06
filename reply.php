

			<!--- 댓글 불러오기 -->
			<div class="reply_view">
				<h3>댓글목록</h3>
				<?php
				$insert_query ="select * from reply where con_num='".$num."' order by idx desc";
				$sql3 = mysqli_query($con, $insert_query);
				while($reply = $sql3->fetch_array()){ 
					?>
					<div class="dap_lo">
						<div><b><?php echo $reply['name'];?></b></div>
						<div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
						<div class="rep_me dap_to"><?php echo $reply['date']; ?></div>
						<div class="rep_me rep_menu">
							<a class="dat_edit_bt" href="#" method="post">수정</a>
							<a class="dat_delete_bt" href="#">삭제</a>
						</div>

						<!-- 댓글 수정 폼 dialog -->
						<div class="dat_edit">
							<form method="post" action="reply_modify_ok.php">
								<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $num; ?>">
								<input type="password" name="pw" class="dap_sm" placeholder="비밀번호" />
								<textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
								<input type="submit" value="수정하기" class="re_mo_bt">
							</form>
						</div>
						<!-- 댓글 삭제 비밀번호 확인 -->
						<div class='dat_delete'>
							<form action="reply_delete.php" method="post">
								<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $num; ?>">
								<p>비밀번호<input type="password" name="pw" /> <input type="submit" value="확인"></p>
							</form>
						</div>
					</div>
				<?php } ?>

				<!--- 댓글 입력 폼 -->
				<div class="dap_ins">
					<form action="reply_ok.php?idx=<?php echo $num; ?>" method="post">
						<input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디">
						<input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
						<div style="margin-top:10px; ">
							<textarea name="content" class="reply_content" id="re_content" ></textarea>
							<button id="rep_bt" class="re_bt">댓글</button>

						</div>
					</form>
				</div>
			</div>
			<!--- 댓글 불러오기 끝 -->
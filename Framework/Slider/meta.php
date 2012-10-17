
<?php $i = $_GET['index']; ?>

<div class="postbox " id="slide<?php echo $i; ?>"><div title="Click to toggle" class="handlediv"><br></div><h3 class="hndle"><span>Slide <?php echo $i; ?></span></h3><div class="inside"><p>Configure your slide to show video or image</p><table class="form-table lf-admin-post-meta-table"><tbody>



<tr id="slide_type_<?php echo $i; ?>-hook">

					<th><label for="slide_type_<?php echo $i; ?>"><strong class="lf-admin-post-meta-th-strong">Type</strong><span class="lf-admin-post-meta-th-span">Chose the type of slide you want to have</span></label></th><td><select name="main_meta[slide_type_<?php echo $i; ?>]" class="lf-admin-post-meta-td-select" id="lf-post-meta-slide_type_<?php echo $i; ?>"><option selected="selected" value="image">Image</option>

<option value="video">Video</option>
</select>

					</td>

				</tr>

				<tr id="slide_embed_<?php echo $i; ?>-hook" style="display: none;">

					<th>

						<label for="slide_embed_<?php echo $i; ?>">

							<strong class="lf-admin-post-meta-th-strong">Embed</strong>

							<span class="lf-admin-post-meta-th-span">Embed your youtube or vimeo video</span>

						</label>

					</th>

					<td>

						<textarea name="main_meta[slide_embed_<?php echo $i; ?>]" rows="5" class="lf-admin-post-meta-td-text" type="text" id="lf-post-meta-slide_embed_<?php echo $i; ?>"></textarea>

					</td>

				</tr>

				<script>reveal.reveal("#lf-post-meta-slide_type_<?php echo $i; ?>","#slide_embed_<?php echo $i; ?>-hook",["video"] );</script>


				<tr id="slide_caption_1-hook">

					<th>

						<label for="slide_caption_$">

							<strong class="lf-admin-post-meta-th-strong">Caption</strong>

							<span class="lf-admin-post-meta-th-span">The caption for your image, leave blank if no caption is desired</span>

						</label>

					</th>

					<td>

						<input type="text" value="" name="main_meta[slide_caption_1]" class="lf-admin-post-meta-td-text" id="lf-post-meta-slide_caption_1">

					</td>

				</tr>

				<script>reveal.reveal("#lf-post-meta-slide_type_<?php echo $i; ?>","#slide_caption_<?php echo $i; ?>-hook",["image"] );</script>


				<tr id="slide_upload_<?php echo $i; ?>-hook"><th><label for="slide_upload_<?php echo $i; ?>">

					<strong class="lf-admin-post-meta-th-strong">Upload Image</strong>

					<span class="lf-admin-post-meta-th-span">Upload your slide image</span>

				</label>

			</th>

			<td>

				<input type="hidden" value="" name="main_meta[slide_upload_<?php echo $i; ?>]" class="lf-admin-post-meta-td-text" id="lf-post-meta-slide_upload_<?php echo $i; ?>">

				<input type="button" value="Upload Image" class="button lf-admin-post-meta-td-button" id="lf-post-meta-slide_upload_<?php echo $i; ?>-button">

			</td>

		</tr>

		<script>reveal.reveal("#lf-post-meta-slide_type_<?php echo $i; ?>","#slide_upload_<?php echo $i; ?>-hook",["image"] );</script>

		<script>load.upload( "#lf-post-meta-slide_upload_<?php echo $i; ?>-button", "#lf-post-meta-slide_upload_<?php echo $i; ?>" );</script>

	</tbody>

</table>

</div>

</div>
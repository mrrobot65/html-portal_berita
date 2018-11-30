<div class="row">
	<div class="col-md-12">
		<h3>My posts</h3>
		<?php if($data['posts'] && !empty($data['posts'])): ?>
			<div class="table-responsive">
				<table class="table posts-table table-striped table-hover">
					<thead>
						<tr>
							<th>Gambar</th>
							<th>Judul</th>
							<th>Kategori</th>
							<th>Tanggal</th>
							<th>
								Action
								<a href="<?php echo base_url('post/add'); ?>" class="pull-right"><i class="fa fa-fw fa-plus"></i> Tambah berita</a>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($data['posts'] as $post): ?>
							<tr>
								<td>
									<img src="<?php echo assets_url('uploads/' . $post->image); ?>" class="thumbnail img-responsive" alt="<?php echo $post->title; ?>?" />
								</td>
								<td>
									<?php echo $post->title; ?>
								</td>
								<td>
									<?php echo (($category = get_category($post->idpost)) ? $category[0]->title : ''); ?>
								</td>
								<td>
									<?php echo date('d M, Y', strtotime($post->add_date)); ?>
								</td>
								<td>
									<a href="<?php echo base_url('news/detail/' . $post->idpost); ?>">
										<i class="fa fa-fw fa-desktop"></i> Tinjauan
									</a>
									&nbsp; | &nbsp;
									<a href="<?php echo base_url('post/delete/' . $post->idpost); ?>">
										<i class="fa fa-fw fa-times"></i> Hapus
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php else: ?>
			<p class="alert bg-info">
				<i class="fa fa-fw fa-exclamation"></i> Terbitan tidak ditemukan. <a href="<?php echo base_url('post/add'); ?>">Tambahkan terbitan pertama anda.</a> now.
			</p>
		<?php endif; ?>
	</div>
</div>
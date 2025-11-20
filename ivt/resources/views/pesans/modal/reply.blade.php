<div class="modal fade" id="balas_pesan_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Balas Pesan</h5>
            </div>
            <form action="{{ route('pesan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    
                    <div class="form-group">
					    <label for="reply_recipient_name">Kepada:</label>
					
					    {{-- VISIBLE, READ-ONLY NAME FIELD (filled by JS) --}}
					    <input type="text" id="reply_recipient_name" class="form-control" readonly>
					
					    {{-- HIDDEN FIELD FOR THE ID (passed to the controller) --}}
					    <input type="hidden" name="to_user_id" id="reply_to_user_id_hidden">
					</div>

                    {{-- 2. Subject --}}
                    <div class="form-group">
                        <label for="reply_subject">Judul/Subject</label>
                        <input type="text" name="subject" id="reply_subject" class="form-control" required>
                    </div>

                    {{-- 2. READ-ONLY QUOTE BLOCK for Original Message --}}
                    <div class="form-group">
                        <label>Pesan Asli:</label>
                        {{-- Use a non-editable HTML element (like a blockquote or a styled div) --}}
                        <blockquote class="blockquote border p-3 bg-light" 
                                    style="max-height: 150px; overflow-y: auto; font-size: 0.9rem;">
                            <div id="quoted_original_message">
                                Memuat pesan asli...
                            </div>
                        </blockquote>
                    </div>

                    {{-- 3. Message Body for NEW REPLY --}}
                    <div class="form-group">
                        <label for="reply_message_text">Isi Balasan Anda</label>
                        <textarea name="message_text" id="reply_message_text" class="form-control" rows="5" 
                                  placeholder="Tulis balasan Anda di sini..." required></textarea>
                    </div>

                </div>
                 <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Kirim Balasan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
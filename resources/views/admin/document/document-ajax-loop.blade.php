@if(isset($document_list))

    @foreach($document_list as $key => $item)

        <div class="i-docs">
            <a href="{{$item['document_url']}}" target="_blank">
                <img class="img-100" src="{{$item['document_icon']}}" name="request_document[]">
            </a>
            <input type="hidden" value="{{$item['document_url']}}" class="request-document"/>
            <input type="hidden" value="{{$item['document_mini_icon']}}" class="document-type"/>
            <input type="hidden" value="{{$item['document_id']}}" class="document-id"/>
            <a href="javascript:void(0)" onclick="deleteServiceDocument(this)"><i class="icons ic-del"></i></a>
        </div>

    @endforeach

@endif

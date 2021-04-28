<?php
function message(){
    $message = "You don,t have permission to access this feature";
    return $message;
}
function routeName(){
    $route = \Route::current()->getName();
    return $route;
}

function showMenu($cat_id = null){
        $menus = '';
        $menus .= generate_multilevel_menues($cat_id);
        return $menus;
}

function generate_multilevel_menues($parent_id = null){
        $multi_cat = '';
        $menu = '';
        if(is_null($parent_id)){
            $multi_cat = \App\Models\Category::where('parent_id',null)->get();
        }else{
            $multi_cat = \App\Models\Category::where('parent_id',$parent_id)->get();
        }

        foreach ($multi_cat as $c){

            if($c->title){
                    $menu .= '<li><a href="javascript:void(0)" id="ch_'.$c->id.'" onclick="selectId('.$c->id.')">'.$c->title.'</a>';
            }
            $menu .= '<ul>'.generate_multilevel_menues($c->id).'</ul>';
            $menu .= '</li>';
        }
        return $menu;
    }



function showSliding($cat_id = null){
    $menus = '';
    $menus .= generate_multilevel_sliding($cat_id);
    return $menus;
}

function generate_multilevel_sliding($parent_id = null){
    $multi_cat = '';
    $menu = '';
    if(is_null($parent_id)){
        $multi_cat = \App\Models\Category::where('parent_id',null)->get();
    }else{
        $multi_cat = \App\Models\Category::where('parent_id',$parent_id)->get();
    }

    foreach ($multi_cat as $c){
        if($c->title){
            $menu .= "<div class='card collapsed-card'>
        <div class='card-header'>
            <h3 class='card-title'>$c->title</h3>

            <div class='card-tools'>
                <button type='button' class='btn btn-tool' data-card-widget='collapse' data-toggle='tooltip' title='Collapse'>
                    <i class='fas fa-plus'></i></button>
                <button type='button' class='btn btn-tool' data-card-widget='remove' data-toggle='tooltip' title='Remove'>
                    <i class='fas fa-times'></i></button>
            </div>
        </div>

            ";
        }
        $menu .= "<div class='card-body' style='display: none;'>";
        $menu .= "<table class='table table-striped'>
                            <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>image</th>
                                <th>Parent ID</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>$c->id</td>
                                    <td>$c->title</td>
                                    <td>
                                        <img src='/storage/cat_img/".$c->image."' style='width: 100px' />
                                    </td>
                                    <td>$c->parent_id</td>
                                    <td>$c->description</td>
                                    <td>
                                        <a href='category-edit/".$c->id."' class='btn btn-primary'>Edit</a>
                                        <a href='javascript:void(0)' class='btn btn-primary' onclick=deleteRow('category-delete/$c->id')>Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>";
        $menu .= generate_multilevel_sliding($c->id);
        $menu .= "</div></div>";
    }
    return $menu;
}

function assets($cat_id = null){
    $menus = '';
    $menus .= asset_sliding($cat_id);
    return $menus;
}

function asset_sliding($parent_id = null){
    $multi_cat = '';
    $menu = '';
    if(is_null($parent_id)){
        $multi_cat = \App\Models\Category::where('parent_id',null)->get();
    }else{
        $multi_cat = \App\Models\Category::where('parent_id',$parent_id)->get();
    }

    foreach ($multi_cat as $c){
        if($c->title){
            $menu .= "<div class='card collapsed-card'>
        <div class='card-header'>
            <h3 class='card-title'>$c->title</h3>

            <div class='card-tools'>
                <button type='button' class='btn btn-tool' data-card-widget='collapse' data-toggle='tooltip' title='Collapse'>
                    <i class='fas fa-plus'></i></button>
                <button type='button' class='btn btn-tool' data-card-widget='remove' data-toggle='tooltip' title='Remove'>
                    <i class='fas fa-times'></i></button>
            </div>
        </div>

            ";
        }

        $menu .= "<div class='card-body' style='display: none;'>";
        $asset = App\Models\Asset::where('category_id',$c->id)->get();
        if(count($asset) >= 1)
        {
            foreach ($asset as $c) {
                $fabric = App\Models\Fabric::find($c->fabric_id);
                $category = App\Models\Category::find($c->category_id);
                    $menu .= "<table class='table table-striped'>
                            <thead>
                            <tr>
                                 <th>Sr.No</th>
                                <th>Title</th>
                                <th>Fabric</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>$c->title</td>
                                <td>$fabric->title</td>
                                <td>$category->title</td>
                                <td><img src='/storage/asset_image/$c->image' style='width: 100px'></td>
                                <td>$c->description</td>
                                <td>
                                    <a href='asset-edit/".$c->id."' class='btn btn-primary'>Edit</a>
                                    <a href='javascript:void(0)' class='btn btn-primary' onclick=deleteRow('asset-delete/$c->id')>Delete</a>
                                </td>
                            </tr>
                            </tbody>
                            </table>";
                $menu .= asset_sliding($c->category_id);
            }

        }else{
            $menu .= asset_sliding($c->id);
        }
        $menu .= "</div></div>";
    }
    return $menu;
}





function assetsMenu($cat_id = 0){
    $menus = '';
    $menus .= multi_assets_menu($cat_id);
    return $menus;
}

function multi_assets_menu($parent_id = 0){
    $multi_cat = '';
    $menu = '';
    if(is_null($parent_id)){
        $multi_cat = \App\Models\Asset::where('product_category_id',null)->get();
    }else{
        $multi_cat = \App\Models\Asset::where('product_category_id',$parent_id)->get();
    }

    foreach ($multi_cat as $c){

        if($c->name){
            $menu .= '<li><input type="radio" name="product_category_id" value="'.$c->id.'" required>'.$c->name;
        }
        $menu .= '<ul>'.multi_assets_menu($c->id).'</ul>';
        $menu .= '</li>';
    }
    return $menu;
}

function getAllAssetsApi($product_category_id,$product_id){
    $assets = '';
    if($product_category_id == 0){
        $assets = \App\Models\Asset::where('product_category_id',0)->where('product_id',$product_id)->get();
    }else{
        $assets = \App\Models\Asset::where('product_category_id',$product_category_id)->where('product_id',$product_id)->get();
    }
    foreach ($assets as $key => $asset){
        $asset['sub_category'] = getAllAssetsApi($asset->id,$product_id);
    }
    return $assets;
}

function productAssetsGet($product_category_id,$product_id){
    $assets = '';
    $menu = '';
    if($product_category_id == 0){
        $assets = \App\Models\Asset::where('product_category_id',0)->where('product_id',$product_id)->get();
    }else{
        $assets = \App\Models\Asset::where('product_category_id',$product_category_id)->where('product_id',$product_id)->get();
    }
    foreach ($assets as $key => $asset){
        if($asset->name){
            $menu .= '<li><a href="">'.$asset->name.'</a>';
        }

        $menu .='<ul>'.productAssetsGet($asset->id,$product_id).'</ul>';
        $menu .= '</li>';
    }
    return $menu;
}






<div class="about_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="about_taital">Các sản phẩm của cửa hàng</h1>
                <div class="bulit_icon"><img src="{{ asset('html/images/bulit-icon.png') }}"></div>
            </div>
        </div>
        <div class="container my-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="filter-box">
                        <h5 class="mb-3 text-center">Bộ lọc sản phẩm</h5>
                        <div class="text-center align-items-center">
                            <div class="mb-3">
                                <select class="form-select" id="sortPrice">
                                    <option value="">Sắp xếp</option>
                                    <option value="asc">Thấp - Cao</option>
                                    <option value="desc">Cao - Thấp</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <select class="form-select" id="genderFilter">
                                    <option value="">Giới tính</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <select class="form-select" id="categoryFilter">
                                    <option value="">Phân loại</option>
                                    <option value="Áo thun thể thao">Áo thun thể thao</option>
                                    <option value="Giày thể thao">Giày thể thao</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <select class="form-select" id="colorFilter">
                                    <option value="">Màu sắc</option>
                                    <option value="Đen">Đen</option>
                                    <option value="Xanh">Xanh</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <select class="form-select" id="sizeFilter">
                                    <option value="">Size</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <input type="number" class="form-control mb-2" id="minPrice"
                                    placeholder="Giá nhỏ nhất">
                                <input type="number" class="form-control" id="maxPrice" placeholder="Giá lớn nhất">
                            </div>

                            <button id="applyFilterBtn" class="btn w-100" style="background-color: #d48272;">Áp dụng bộ
                                lọc</button>
                            <button id="resetFilterBtn" class="btn w-100 mt-2"
                                style="background-color: #6c757d; color: white;">Xóa bộ lọc</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row" id="product-list"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function fetchProducts() {
            let gender = $("#genderFilter").val();
            let type = $("#categoryFilter").val();
            let color = $("#colorFilter").val();
            let size = $("#sizeFilter").val();
            let minPrice = $("#minPrice").val();
            let maxPrice = $("#maxPrice").val();
            let sortPrice = $("#sortPrice").val();

            let apiUrl =
                `https://main.vienthong3g.vn/VnetManager/api.jsp?chart=zipchat_huy&node=Start&g=${gender}&t=${type}&c=${color}&s=${size}&min=${minPrice}&max=${maxPrice}`;

            $.ajax({
                url: apiUrl,
                method: "GET",
                dataType: "json",
                success: function(response) {
                    if (sortPrice === "asc") {
                        response.sort((a, b) => a.price - b.price);
                    } else if (sortPrice === "desc") {
                        response.sort((a, b) => b.price - a.price);
                    }

                    let html = '';

                    if (response.length === 0) {
                        html =
                            `<div class="col-12 text-center"><h5 class="text-danger mt-4">Không có sản phẩm nào tương ứng!</h5></div>`;
                    } else {
                        response.forEach(product => {
                            html += `
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card product-card shadow-sm border-0">
                                <div class="product-image">
                                    <img src="${product.img}" class="card-img-top" alt="${product.name}">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bolder fs-1">${product.name}</h5>
                                    <p class="card-text text-muted">${product.type}</p>
                                    <p class="text-danger fw-bold fs-5">${product.price.toLocaleString()} VNĐ</p>
                                    <div class="d-flex justify-content-between">
                                        <a href="/product/${product.id}" class="btn btn-outline-danger small-btn text-center" style="border-color: #d98473; color: #d98473;">
                                            Xem chi tiết
                                        </a>
                                        <button class="btn add-to-cart small-btn text-center" data-id="${product.id}" style="background-color: #d98473; color: white;">
                                            Thêm vào giỏ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                        });
                    }
                    $('#product-list').html(html);
                },
                error: function() {
                    $('#product-list').html(
                        '<p class="text-danger text-center">Không thể tải dữ liệu sản phẩm.</p>'
                    );
                }
            });
        }

        // Gọi API lần đầu tiên khi trang tải xong
        fetchProducts();

        // Khi nhấn nút "Áp dụng bộ lọc"
        $("#applyFilterBtn").on("click", function() {
            fetchProducts();
        });

        // Khi thay đổi sắp xếp
        $("#sortPrice").on("change", function() {
            fetchProducts();
        });


        // Gọi API lần đầu tiên khi trang tải xong
        fetchProducts();

        // Khi nhấn nút "Áp dụng bộ lọc"
        $("#applyFilterBtn").on("click", function() {
            fetchProducts();
        });

        // Khi nhấn nút "Xóa bộ lọc"
        $("#resetFilterBtn").on("click", function() {
            $("#genderFilter").val("");
            $("#categoryFilter").val("");
            $("#colorFilter").val("");
            $("#sizeFilter").val("");
            $("#minPrice").val("");
            $("#maxPrice").val("");
            fetchProducts();
        });

        // Xử lý thêm vào giỏ hàng
        $(document).on("click", ".add-to-cart", function() {
            let productId = $(this).data("id");
            alert("Đã thêm sản phẩm ID: " + productId + " vào giỏ hàng!");
        });
    });
</script>

<style>
    .product-card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        height: 250px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f8f9fa;
    }

    .product-image img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }

    .small-btn {
        padding: 5px 10px;
        font-size: 14px;
        width: auto;
        min-width: 100px;
        text-align: center;
    }

    .filter-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .filter-box h5 {
        font-weight: bold;
        color: #333;
        text-align: center;
    }

    .filter-box .form-label {
        font-weight: 500;
        color: #555;
    }

    .filter-box .mb-3 {
        margin-bottom: 15px;
    }

    .filter-box select,
    .filter-box input {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 8px;
        font-size: 14px;
    }

    .filter-box select:hover,
    .filter-box input:hover {
        border-color: #007bff;
    }

    .filter-box .btn {
        background: #007bff;
        color: white;
        font-weight: bold;
        border-radius: 8px;
        padding: 10px;
        transition: 0.3s ease-in-out;
    }

    .filter-box .btn:hover {
        background: #0056b3;
    }
</style>

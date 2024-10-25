<div class="col-lg-6 col-12 ps-lg-5">
                <div class="sticky-sidebar">
                    <div class="border p-5 rounded-4">
                        <h5 class="fw-bold pb-2">Your order </h5>
                        <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                            <h6 class="fw-bold mb-0">Product </h6>
                            <h6 class="fw-bold mb-0">Subtotal </h6>
                        </div>
                        
                        <?php 
                        $grandTotal = 0;
                        foreach($_SESSION['cart'] as $item): 
                            $itemTotal = $item['producttotal']; 
                            $grandTotal += $itemTotal;
                        ?>

                        <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                            <h6 class="mb-0 lh-20">
                                <?php echo htmlspecialchars($item['productname']); ?> × <?php echo htmlspecialchars($item['productqty']); ?> <br>
                                <?php if (($item['modifiername']) !=='No Addon'): ?>
                                    <span class="item_desc">Addon : <?php echo htmlspecialchars($item['modifiername']); ?></span>
                                <?php endif; ?>
                             </h6>
                            <p class="mb-0">$<?php echo htmlspecialchars(number_format($itemTotal, 2)); ?></p>
                        </div>
                        <?php endforeach; ?>

                        <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                            <h6 class="fw-bold mb-0">Subtotal </h6>
                            <p class="fw-bold mb-0">$<?php echo $grandTotal ?></p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                            <h6 class="fw-bold mb-0">Tax 7% </h6>
                            <p class="fw-bold mb-0">$<?php echo htmlspecialchars(number_format($tax, 2)); ?></p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                            <h6 class="fw-bold mb-0">Tip </h6>
                            <p class="fw-bold mb-0">$0</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-3">
                            <h5 class="fw-bold mb-0 text-purple">Total </h5>
                            <p class="fw-bold mb-0 h5 text-purple">$<?php echo htmlspecialchars(number_format($total, 2)); ?></p>
                        </div>                       
                    </div>
                </div>
            </div>
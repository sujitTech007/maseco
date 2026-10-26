<?php

namespace Tests\Unit;

use App\Models\SampleOrder;
use PHPUnit\Framework\TestCase;

class SampleOrderTransitionsTest extends TestCase
{
    public function test_expected_sample_order_transitions_are_allowed(): void
    {
        $this->assertTrue(SampleOrder::canTransition('awaiting_approval', 'awaiting_payment'));
        $this->assertTrue(SampleOrder::canTransition('awaiting_approval', 'rejected'));
        $this->assertTrue(SampleOrder::canTransition('awaiting_payment', 'processing'));
        $this->assertTrue(SampleOrder::canTransition('processing', 'shipped'));
        $this->assertTrue(SampleOrder::canTransition('shipped', 'delivered'));
    }

    public function test_invalid_or_terminal_transitions_are_rejected(): void
    {
        $this->assertFalse(SampleOrder::canTransition('awaiting_approval', 'paid'));
        $this->assertFalse(SampleOrder::canTransition('processing', 'delivered'));
        $this->assertFalse(SampleOrder::canTransition('delivered', 'cancelled'));
        $this->assertFalse(SampleOrder::canTransition('rejected', 'awaiting_payment'));
    }
}

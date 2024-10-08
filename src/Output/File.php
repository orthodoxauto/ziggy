<?php

namespace Tighten\Ziggy\Output;

use Stringable;
use Tighten\Ziggy\Ziggy;

class File implements Stringable
{
    protected $ziggy;

    public function __construct(Ziggy $ziggy)
    {
        $this->ziggy = $ziggy;
    }

    public function __toString(): string
    {
        return <<<JAVASCRIPT
var Ziggy = {$this->ziggy->toJson()};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };

JAVASCRIPT;
    }
}

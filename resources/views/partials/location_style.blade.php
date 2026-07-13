<style>
.position-relative {
    position: relative;
}

#from_suggestions,
#to_suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 1000;

    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 6px;

    max-height: 220px;
    overflow-y: auto;

    display: none;
    margin-top: 4px;

    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
}

#from_suggestions div,
#to_suggestions div {
    padding: 10px 14px;
    cursor: pointer;
    font-size: 14px;
    color: #333;
    border-bottom: 1px solid #f1f1f1;
    transition: background 0.2s ease;
}

#from_suggestions div:last-child,
#to_suggestions div:last-child {
    border-bottom: none;
}

#from_suggestions div:hover,
#to_suggestions div:hover {
    background-color: #f8f9fa;
}
</style>